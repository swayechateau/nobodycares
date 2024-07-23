<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Symfony\Component\Yaml\Yaml;
use Illuminate\Support\Facades\Log;

use Parsedown;

use DOMDocument;
use Highlight\Highlighter;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['filename', 'slug', 'title', 'featured', 'excerpt', 'hero_image', 'category', 'author', 'content', 'locale', 'read_time'];

    protected $casts = [
        'featured' => 'boolean',
    ];

    protected $appends = ['full_url'];

    protected $hidden = [
        'filename',
    ];

    /**
     * Get the full URL of the post.
     *
     * @return string
     */
    public function getFullUrlAttribute()
    {
        // Assuming you have 'locale' and 'slug' as attributes of the Post model
        $url = config('app.url'); // Retrieve the base URL from your app's config
        return "{$url}/{$this->locale}/posts/{$this->slug}";
    }
    /**
     * Get the directory path to the markdown files based on the locale.
     *
     * @return string
     */
    public function getMarkdownDirectory(): string
    {
        return resource_path("markdown/{$this->locale}");
    }

    /**
     * Get the full path to the markdown file.
     *
     * @return string
     */
    public function getMarkdownFilePath(): string
    {
        return $this->getMarkdownDirectory() . "/{$this->filename}.md";
    }

    /**
     * Get the content of the markdown file.
     *
     * @return string
     */
    public function getMarkdownFile(): string {
        $filePath = $this->getMarkdownFilePath();

        if (!File::exists($filePath)) {
            // delete the post from the database
            $this->delete();
            return '';
        }

        return File::get($filePath);
    }

    /**
     * Parse the markdown content to HTML.
     *
     * @return string
     */
    public function parseMarkdownContent(): string
    {
        $converter = new Parsedown();
        $html = $converter->text($this->content);
        return highlightCode($html);
    }

    /**
     * Cache the parsed markdown content.
     */
    public function cache(): void
    {
        $filePath = $this->getMarkdownFilePath();

        if (!File::exists($filePath)) {
            Log::warning("Markdown file not found for post ID {$this->id}: {$filePath}");
            if ($this->exists) {
                $this->delete(); // Delete the post if it exists but the file does not
            }
            return;
        }

        $fileLastModified = File::lastModified($filePath);

        if (!$this->exists || $this->updated_at->timestamp < $fileLastModified) {
            $markdownContent = $this->getMarkdownFile();
            $parsedContent = $this->parseMarkdownFile($markdownContent);

            $this->filename = $parsedContent['filename'];
            $this->locale = $parsedContent['locale'] ?? $this->locale;
            $this->title = $parsedContent['title'];
            $this->featured = $parsedContent['featured'];
            $this->excerpt = $parsedContent['excerpt'];
            $this->hero_image = $parsedContent['hero_image'];
            $this->category = $parsedContent['category'];
            $this->author = $parsedContent['author'];
            $this->content = $parsedContent['content'];
            $this->read_time = $this->calculateReadTime($parsedContent['content']);

            $this->save();
        }
    }
    
    function calculateReadTime($content) {
        $wordCount = str_word_count(strip_tags($content));
        return ceil($wordCount / 200); // 200 words per minute
    }

    /**
     * Parse the markdown file content.
     *
     * @param string $file
     * @return array
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function parseMarkdownFile(string $file): array
    {
        if (!File::exists($file)) {
            throw new \Illuminate\Contracts\Filesystem\FileNotFoundException("File not found at path: {$file}");
        }

        $fileContent = File::get($file);
        $filename = pathinfo($file, PATHINFO_FILENAME);

        // Default values
        $title = str_replace('-', ' ', ucfirst($filename));
        $featured = false;
        $excerpt = '';
        $locale = 'en';
        $hero_image = 'https://via.placeholder.com/150';
        $category = '';
        $author = 'NobodyCares';
        $content = $fileContent;
        $slug = $filename;

        // Extracting YAML front matter
        if (preg_match('/---(.*?)---/s', $fileContent, $matches)) {
            $yaml = Yaml::parse($matches[1]);

            // Extract the necessary details
            $slug = $yaml['slug'] ?? $slug;
            $title = $yaml['title'] ?? $title;
            $locale = $yaml['locale'] ?? $locale;
            $featured = $yaml['featured'] ?? $featured;
            $excerpt = $yaml['excerpt'] ?? $excerpt;
            $hero_image = $yaml['hero_image'] ?? $hero_image;
            $category = $yaml['category'] ?? $category;
            $author = $yaml['author'] ?? $author;
            $content = str_replace($matches[0], '', $fileContent); // Save content without front matter
        }

        // Build post data array
        return [
            'filename' => $filename,
            'locale' => $locale,
            'slug' => $slug,
            'title' => $title,
            'featured' => $featured,
            'excerpt' => $excerpt,
            'hero_image' => $hero_image,
            'category' => $category,
            'author' => $author,
            'content' => $content,
        ];
    }

}

// Markdown Code Parsers
function highlightCode($html) {
    $pattern = '/<code class="(?P<class>language-(csharp|golang|php|javascript|kotlin|swift|bash|elixir))">(?P<code>.*?)<\/code>/s';

    $html = preg_replace_callback($pattern, function ($matches) {
        $language = str_replace('language-', '', $matches['class']);
        $code = html_entity_decode($matches['code']);
        $highlighted = highlightLangCode($code, $language);
        return '<code class="' . $matches['class'] . '">' . htmlspecialchars($highlighted) . '</code>';
    }, $html);

    return html_entity_decode($html);
}

function highlightLangCode($code, $language) {
    $highlighter = new Highlighter();
    try {
        $highlighted = $highlighter->highlight($language, $code);
        return $highlighted->value;
    } catch (\Exception $e) {
        if ($e->getMessage() !== 'Unknown language') {
            return $code;
        }
        dd($language);
        if ($language === 'golang') {
            return highlightGolang($code);
        }
        return $code;
    }

    // switch ($language) {
    //     case 'csharp':
    //         return highlightCSharp($code);
    //     case 'golang':
    //         return highlightGolang($code);
    //     case 'php':
    //         return highlightPHP($code);
    //     case 'javascript':
    //         return highlightJavaScript($code);
    //     case 'kotlin':
    //         return highlightKotlin($code);
    //     case 'swift':
    //         return highlightSwift($code);
    //     case 'bash':
    //         return highlightBash($code);
    //     case 'elixir':
    //         return highlightElixir($code);
    //     default:
    //         return htmlspecialchars($code);
    // }
}

function highlightCSharp($code) {
    // Define the patterns
    $keywords = '/\b(abstract|as|base|bool|break|byte|case|catch|char|checked|class|const|continue|decimal|default|delegate|do|double|else|enum|event|explicit|extern|false|finally|fixed|float|for|foreach|goto|if|implicit|in|int|interface|internal|is|lock|long|namespace|new|null|object|operator|out|override|params|private|protected|public|readonly|ref|return|sbyte|sealed|short|sizeof|stackalloc|static|string|struct|switch|this|throw|true|try|typeof|uint|ulong|unchecked|unsafe|ushort|using|virtual|void|volatile|while)\b/';
    $strings = '/(".*?")/';
    $comments = '/(\/\/[^\n]*\n)/';

    // Perform replacements
    $code = replaceComments($code, $comments);
    $code = replaceStrings($code, $strings);
    $code = replaceKeywords($code, $keywords);

    // Correct handling of HTML entities: Encode before highlighting to prevent double encoding
    $highlightedCode = htmlspecialchars($code, ENT_NOQUOTES, 'UTF-8');
    
    return $highlightedCode;
}

function highlightGolang($code) {
    // Define the patterns
    $keywords = '/\b(break|default|func|interface|select|case|defer|go|map|struct|chan|else|goto|package|switch|const|fallthrough|if|range|type|import|return|var|continue|for)\b/';
    $strings = '/"([^"\\\\]*(?:\\\\.[^"\\\\]*)*)"|`([^`]*)`/';
    $comments = '/\/\/[^\n]*\n/';
    $types = '/\b(string|int|int8|int16|int32|int64|uint|uint8|uint16|uint32|uint64|uintptr|byte|rune|float32|float64|complex64|complex128|bool|error)\b/';

    // Perform replacements
    $code = replaceComments($code, $comments);
    $code = replaceStrings($code, $strings);
    $code = replaceTypes($code, $types);
    $code = replaceKeywords($code, $keywords);

    // Correct handling of HTML entities: Encode before highlighting to prevent double encoding
    $highlightedCode = htmlspecialchars($code, ENT_NOQUOTES, 'UTF-8');
    return $highlightedCode;
}

function highlightPHP($code) {
    // Define the patterns
    $keywords = '/\b(abstract|and|as|array|break|callable|case|catch|class|clone|const|continue|declare|default|die|do|echo|else|elseif|empty|enddeclare|endfor|endforeach|endif|endswitch|endwhile|eval|exit|extends|final|finally|for|foreach|function|global|goto|if|implements|include|include_once|instanceof|insteadof|interface|isset|list|namespace|new|or|print|private|protected|public|require|require_once|return|static|switch|throw|trait|try|unset|use|var|while|xor|yield)\b/';
    $strings = '/"([^"\\\\]*(?:\\\\.[^"\\\\]*)*)"|\'([^\'\\\\]*(?:\\\\.[^\'\\\\]*)*)\'/';
    $comments = '/\/\/[^\n]*\n|\/\*[\s\S]*?\*\//';
    $types = '/\b(bool|boolean|int|integer|float|double|string|array|object|resource|void|callable|iterable)\b/';

    // Perform replacements
    $code = replaceComments($code, $comments);
    $code = replaceStrings($code, $strings);
    $code = replaceTypes($code, $types);
    $code = replaceKeywords($code, $keywords);

    // Correct handling of HTML entities: Encode before highlighting to prevent double encoding
    $highlightedCode = htmlspecialchars($code, ENT_NOQUOTES, 'UTF-8');
    return $highlightedCode;
}

function highlightJavaScript($code) {
    // Define the patterns
    $keywords = '/\b(break|default|func|interface|select|case|defer|go|map|struct|chan|else|goto|package|switch|const|fallthrough|if|range|type|import|return|var|continue|for)\b/';
    $strings = '/"([^"\\\\]*(?:\\\\.[^"\\\\]*)*)"|`([^`]*)`/';
    $comments = '/\/\/[^\n]*\n/';
    $types = '/\b(string|int|int8|int16|int32|int64|uint|uint8|uint16|uint32|uint64|uintptr|byte|rune|float32|float64|complex64|complex128|bool|error)\b/';

    // Perform replacements
    $code = replaceComments($code, $comments);
    $code = replaceStrings($code, $strings);
    $code = replaceTypes($code, $types);
    $code = replaceKeywords($code, $keywords);

    // Correct handling of HTML entities: Encode before highlighting to prevent double encoding
    $highlightedCode = htmlspecialchars($code, ENT_NOQUOTES, 'UTF-8');
    return $highlightedCode;
}

function highlightKotlin($code) {
    // Define the patterns
    $keywords = '/\b(break|default|func|interface|select|case|defer|go|map|struct|chan|else|goto|package|switch|const|fallthrough|if|range|type|import|return|var|continue|for)\b/';
    $strings = '/"([^"\\\\]*(?:\\\\.[^"\\\\]*)*)"|`([^`]*)`/';
    $comments = '/\/\/[^\n]*\n/';
    $types = '/\b(string|int|int8|int16|int32|int64|uint|uint8|uint16|uint32|uint64|uintptr|byte|rune|float32|float64|complex64|complex128|bool|error)\b/';

    // Perform replacements
    $code = replaceComments($code, $comments);
    $code = replaceStrings($code, $strings);
    $code = replaceTypes($code, $types);
    $code = replaceKeywords($code, $keywords);

    // Correct handling of HTML entities: Encode before highlighting to prevent double encoding
    $highlightedCode = htmlspecialchars($code, ENT_NOQUOTES, 'UTF-8');
    return $highlightedCode;
}

function highlightSwift($code) {
    // Define the patterns
    $keywords = '/\b(break|default|func|interface|select|case|defer|go|map|struct|chan|else|goto|package|switch|const|fallthrough|if|range|type|import|return|var|continue|for)\b/';
    $strings = '/"([^"\\\\]*(?:\\\\.[^"\\\\]*)*)"|`([^`]*)`/';
    $comments = '/\/\/[^\n]*\n/';
    $types = '/\b(string|int|int8|int16|int32|int64|uint|uint8|uint16|uint32|uint64|uintptr|byte|rune|float32|float64|complex64|complex128|bool|error)\b/';

    // Perform replacements
    $code = replaceComments($code, $comments);
    $code = replaceStrings($code, $strings);
    $code = replaceTypes($code, $types);
    $code = replaceKeywords($code, $keywords);

    // Correct handling of HTML entities: Encode before highlighting to prevent double encoding
    $highlightedCode = htmlspecialchars($code, ENT_NOQUOTES, 'UTF-8');
    return $highlightedCode;
}

function highlightBash($code) {
    // Define the patterns
    $keywords = '/\b(break|default|func|interface|select|case|defer|go|map|struct|chan|else|goto|package|switch|const|fallthrough|if|range|type|import|return|var|continue|for)\b/';
    $strings = '/"([^"\\\\]*(?:\\\\.[^"\\\\]*)*)"|`([^`]*)`/';
    $comments = '/\/\/[^\n]*\n/';
    $types = '/\b(string|int|int8|int16|int32|int64|uint|uint8|uint16|uint32|uint64|uintptr|byte|rune|float32|float64|complex64|complex128|bool|error)\b/';

    // Perform replacements
    $code = replaceComments($code, $comments);
    $code = replaceStrings($code, $strings);
    $code = replaceTypes($code, $types);
    $code = replaceKeywords($code, $keywords);

    // Correct handling of HTML entities: Encode before highlighting to prevent double encoding
    $highlightedCode = htmlspecialchars($code, ENT_NOQUOTES, 'UTF-8');
    return $highlightedCode;
}

function highlightElixir($code) {
     // Define the patterns
     $keywords = '/\b(break|default|func|interface|select|case|defer|go|map|struct|chan|else|goto|package|switch|const|fallthrough|if|range|type|import|return|var|continue|for)\b/';
     $strings = '/"([^"\\\\]*(?:\\\\.[^"\\\\]*)*)"|`([^`]*)`/';
     $comments = '/\/\/[^\n]*\n/';
     $types = '/\b(string|int|int8|int16|int32|int64|uint|uint8|uint16|uint32|uint64|uintptr|byte|rune|float32|float64|complex64|complex128|bool|error)\b/';
 
     // Perform replacements
     $code = replaceComments($code, $comments);
     $code = replaceStrings($code, $strings);
     $code = replaceTypes($code, $types);
     $code = replaceKeywords($code, $keywords);
 
     // Correct handling of HTML entities: Encode before highlighting to prevent double encoding
     $highlightedCode = htmlspecialchars($code, ENT_NOQUOTES, 'UTF-8');
     return $highlightedCode;
}

function replaceKeywords($code, $pattern) {
    $replacement = '<span class="keyword">$0</span>';
    return preg_replace($pattern, $replacement, $code);
}
function replaceTypes($code, $pattern) {
    $replacement = '<span class="type">$1</span>';
    return preg_replace($pattern, $replacement, $code);
}

function replaceStrings($code, $pattern) {
    $replacement = '<span class="string">$1</span>';
    return preg_replace($pattern, $replacement, $code);
}

function replaceComments($code, $pattern) {
    $replacement = '<span class="comment">$1</span>';
    return preg_replace($pattern, $replacement, $code);
}
