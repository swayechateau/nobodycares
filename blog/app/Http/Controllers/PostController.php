<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\Yaml\Yaml;
use Illuminate\Support\Facades\Log;


use App\Models\Post;

class PostController extends Controller
{
    // API endpoints
    public function rfPosts()
    {
        $locale = 'en';
        $posts = Post::where('locale', $locale)->latest()->take(3)->get()->makeHidden(['content']);
        $featuredPosts = Post::where('locale', $locale)->where('featured', true)->take(3)->get()->makeHidden(['content']);
        return response()->json([
            'recent' => $posts,
            'featured' => $featuredPosts
        ]);
    }

    public function updatePosts()
    {
        // needs to be restricted to those with an api token
        try {
            cachePosts('en');
            return response()->json([
                'message'=>'Posts updated!'
            ], 200);
        } catch (\Exception $e) {
            Log::error("Error updating posts: " . $e->getMessage());
            dd($e->getMessage());
            return response()->json([
                'message'=>'Error updating posts'
            ], 500);
        }
    }

    public function search(Request $request)
    {
        // only this app can access this endpoint
        $validated = $request->validate([
            'query' => 'nullable|string|max:255'
        ]);

        $query = $validated['query'] ?? null;
        if (!$request->expectsJson()) {
            return redirect()->route('posts.index', app()->getLocale(), ['search' => $query]);
        }

        $posts = [];
        if (!$query) {
            $title = "Posts" . " - NobodyCares";
            $posts = Post::latest()->get()->makeHidden(['content']);
            return response()->json([
                "title" => $title,
                "results" => $posts
            ]);
        }

        $title = "Search results for '{$query}' - NobodyCares";
        $posts = Post::where('title', 'like', '%' . $query . '%')
            ->orWhere('content', 'like', '%' . $query . '%')
            ->orWhere('category', 'like', '%' . $query . '%')
            ->get()->makeHidden(['content']);
        return response()->json([
            "title" => $title,
            "results" => $posts
        ]);
    }

    public function home($locale)
    {
        $title =  "NobodyCares";
        // get three latest posts
        $posts = Post::where('locale', $locale)->latest()->take(3)->get();
        $featuredPosts = Post::where('locale', $locale)->where('featured', true)->take(3)->get();
        return view('index', compact('title', 'featuredPosts', 'posts'));
    }

    public function index($locale, Request $request)
    {
        $validated = $request->validate([
            'search' => 'nullable|string|max:255'
        ]);

        $query = $validated['search'] ?? null;
        $categories = Post::select('category')->distinct()->pluck('category');
        if (!$query) {
            $posts = Post::where('locale', $locale)->latest()->get()->makeHidden(['content']);
            $title = "Posts" . " - NobodyCares";
            return view('posts.index', compact('posts', 'title', 'query', 'categories'));
        }
        
        // search for posts
        $posts = Post::where('title', 'like', '%' . $query . '%')
                    ->orWhere('content', 'like', '%' . $query . '%')
                    ->orWhere('category', 'like', '%' . $query . '%')
                    ->get()->makeHidden(['content']);
                    
        $title = "Search results for '{$query}' - NobodyCares";
        return view('posts.index', compact('posts', 'title', 'query', 'categories'));
    }

    public function show($locale, $slug)
    {            
        try {
            // Attempt to find the post by slug
            $post = Post::where('slug', $slug)->first();
            $title = $post->title . ' - NobodyCares';
            // Cache the post content (if exists)
            if ($post->exists) {
                // dd($post);
                $post->cache();
                
                // Check if the locale matches
                if ($post->locale != $locale) {
                    abort(404);
                }

                // Prepare data for the view
                $title = $post->title . ' - NobodyCares';
                $content = $post->parseMarkdownContent();

                return view('posts.show', compact('content', 'post', 'title'));
            } else {
                abort(404); // Post not found
            }
        } catch (\Exception $e) {
            Log::error("Error displaying post with slug '{$slug}': " . $e->getMessage());
            abort(404);
        }
    }

}


// Method to get available posts in a locale
function parsePost($file)
{
    $fileContent = File::get($file);
    $filename = pathinfo($file, PATHINFO_FILENAME);

    $title = str_replace('-',' ',ucfirst($filename));
    $featured = false;
    $excerpt = '';
    $hero_image = 'https://via.placeholder.com/150';
    $category = '';
    $author = 'NobodyCares';
    $content = '';
    
    // Extracting YAML front matter
    if (preg_match('/---(.*?)---/s', $fileContent, $matches)) {
        $yaml = Yaml::parse($matches[1]);

        // Extract the necessary details
        $slug = $yaml['slug'] ?? $filename;
        $title = $yaml['title'] ?? $title;
        $featured = $yaml['featured'] ?? false;
        $excerpt = $yaml['excerpt'];
        $hero_image = $yaml['hero_image'];
        $category = $yaml['category'];
        $author = $yaml['author'];
        $content = str_replace($matches[0], '', $fileContent); // Save content without front matter
    } 
    
    // Build post data array
    return [
        'filename' => $filename,
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

function cachePosts($locale)
{
    $files = getMarkdownPosts($locale);
    foreach ($files as $file) {
        cachePost($locale, $file);
    }
}

function cachePost($locale, $file)
{   
    $filename = pathinfo($file, PATHINFO_FILENAME);
    $post = Post::firstOrNew(['filename' => $filename]);
    
    $fileLastModified = File::lastModified($file);

    if (!$post->exists || $post->updated_at->timestamp < $fileLastModified) {
        $content = parsePost($file);
        $post->filename = $content['filename'];
        $post->slug = $content['slug'];
        $post->locale = $locale;
        $post->title = $content['title'];
        $post->featured = $content['featured'];
        $post->excerpt = $content['excerpt'];
        $post->hero_image = $content['hero_image'];
        $post->category = $content['category'];
        $post->author = $content['author'];
        $post->content = $content['content'];
        $post->read_time = $post->calculateReadTime($content['content']);

    }
        $post->save();
}

function getPosts($locale)
{
    $files = getMarkdownPosts($locale);
    $posts = [];
    foreach ($files as $file) {
        // Build post data array
        $posts[] = parsePost($file);
    }
    return $posts;
}

function getMarkdownPosts($locale)
{
    return File::files(resource_path("markdown/{$locale}"));
}

function parseMarkdown($content)
{
    $converter = new CommonMarkConverter();
    return $converter->convertToHtml($content);
}