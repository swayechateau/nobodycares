<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use League\CommonMark\CommonMarkConverter;

class PostController extends Controller
{
    public function home($locale)
    {
        // $posts = getPosts($locale);
        $title =  "NobodyCares";
        return view('index', compact('title'));
    }

    public function index($locale)
    {
        $posts = getPosts($locale);
        $title = "Blog " . app()->getLocale();
        return view('posts.index', compact('posts', 'title'));
    }

    public function show($locale, $slug)
    {
        $path = resource_path("markdown/{$locale}/{$slug}.md");

        if (!File::exists($path)) {
            abort(404);
        }

        $title = str_replace('-',' ',ucfirst($slug));

        $content = parseMarkdown($path);
        return view('posts.show', compact('content', 'title'));
    }

    public function categories($locale)
    {
        $categories = ['Laravel', 'PHP', 'JavaScript', 'Vue.js', 'React.js'];
        $title = "Categories";
        return view('posts.categories', compact('categories', 'title'));
    }
}


// Method to get available posts in a locale
function getPosts($locale)
{
    $files = File::files(resource_path("markdown/{$locale}"));
    $posts = [];
    foreach ($files as $file) {
        $posts[] = pathinfo($file, PATHINFO_FILENAME);
    }
    return $posts;
}

function parseMarkdown($filePath)
{
    if (file_exists($filePath)) {
        $content = file_get_contents($filePath);
        $converter = new CommonMarkConverter();
        return $converter->convertToHtml($content);
    }
    return null;
}