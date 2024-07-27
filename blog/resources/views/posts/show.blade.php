@extends('layouts.main')
@section('meta')
    <meta name="description" content="{{ $post->excerpt }}">
    <meta name="keywords" content="{{ $post->tags }}">
    <meta name="author" content="{{ $post->author }}">
    <meta property="og:title" content="{{ $post->title }}">
    <meta property="og:description" content="{{ $post->excerpt }}">
    <meta property="og:image" content="{{ $post->hero_image }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="article">
    <meta property="article:published_time" content="{{ $post->created_at }}">
    <meta property="article:modified_time" content="{{ $post->updated_at }}">
    <meta property="article:author" content="{{ $post->author }}">
    <meta property="article:section" content="{{ $post->category }}">
    <meta property="article:tag" content="{{ $post->tags }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $post->title }}">
    <meta name="twitter:description" content="{{ $post->excerpt }}">
    <meta name="twitter:image" content="{{ $post->hero_image }}">
@endsection
@section('content')
    <section id="post-content">
        <!-- post header -->
        <div class="relative" style="height: 35vh; min-height: 350px; rounded-br-[200px] rounded-bl-[200px]">
            <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ $post->hero_image }}'); rounded-br-[200px] rounded-bl-[200px]">
                <div class="flex flex-col justify-center items-center h-full bg-black bg-opacity-40">
                    <h1 class="p-3 text-white text-3xl font-bold">{{ $post->title }}</h1>
                    <div class="text-lg text-blue-200">{{ $post->category }}</div>
                </div>
            </div>
        </div>
        <!-- post content -->
        <div class="relative -mt-10 z-10 px-4 pb-10 grid grid-cols-12 gap-5">
            <article class="bg-[#0d1117] p-3 rounded col-span-12 lg:col-span-9">
                <div class="flex flex-col sm:flex-row p-4 text-lg">
                    <div class="grow">
                        <span class="text-yellow-100 font-bold" data-time="{{$post->updated_at}}">Updated:</span> {{ $post->updated_at->format('F d, Y') }}
                    </div>
                    <div class="p-2 sm:bg-gray-500 text-gray-100 text-sm capitalize rounded text-right">
                        {{ $post->read_time }} minute read
                    </div>
                </div>
                <div class="markdown-body text-lg">
                    {!! $content !!}
                </div>
                <div class="flex flex-col-reverse sm:flex-row p-4 text-lg">
                    <div class="grow">
                        <span class="font-bold text-yellow-100" data-time="{{$post->created_at}}">Created:</span> {{ $post->created_at->format('F d, Y') }}
                    </div>
                    <div class="italic">
                        <span class="font-bold text-gray-100">Author:</span> {{ $post->author }}
                    </div>
                </div>
            </article>
            <div class="col-span-12 lg:col-span-3 relative">
                <aside class="bg-[#333] p-3 rounded flex lg:sticky lg:top-20 w-full">
                    <div class="container mx-auto px-4">
                    <div>
                        <input type="text" class="w-full p-2 bg-gray-800 text-gray-100 rounded focus:outline-none"
                            placeholder="Search">
                    </div>
                        {{-- <hr class="my-4">
                        <h2 class="capitalize font-semibold mb-3">recent posts</h2>
                        <div class="space-y-4">

                        </div> --}}
                    </div>
                </aside>
            </div>
        </div>
    </section>

    {{-- <section id="suggested-posts">
    <h2>Suggested Posts</h2>
    <!-- List of related posts -->
</section> --}}
@endsection

@section('styles')
    <style>
        /* styles.css */
        /* Markdown Styles - Material Design 3 Inspired */

        .markdown-body {
            font-family: 'Roboto', 'Helvetica Neue', Arial, sans-serif;
            color: #ccc;
            line-height: 1.6;
            padding: 1em;
            border-radius: 8px;
        }

        /* Headings */
        .markdown-body h1,
        .markdown-body h2,
        .markdown-body h3,
        .markdown-body h4,
        .markdown-body h5,
        .markdown-body h6 {
            font-weight: 500;
            line-height: 1.2;
            margin: 1em 0 0.5em;
            color: #eee;
        }

        .markdown-body h1 {
            font-size: 2.5em;
        }

        .markdown-body h2 {
            font-size: 2em;
        }

        .markdown-body h3 {
            font-size: 1.75em;
        }

        .markdown-body h4 {
            font-size: 1.5em;
        }

        .markdown-body h5 {
            font-size: 1.25em;
        }

        .markdown-body h6 {
            font-size: 1em;
        }

        /* Paragraphs */
        .markdown-body p {
            margin: 0.5em 0;
        }

        /* Links */
        .markdown-body a {
            color: #0092cc;
            text-decoration: none;
        }

        .markdown-body a:hover {
            text-decoration: underline;
        }

        /* Lists */
        .markdown-body ul,
        .markdown-body ol {
            margin: 0.5em 0 0.5em 1.5em;
        }

        .markdown-body ul li,
        .markdown-body ol li {
            margin: 0.5em 0;
        }

        /* Blockquotes */
        .markdown-body blockquote {
            margin: 1em 0;
            padding: 0.5em 1em;
            border-left: 4px solid #fff;
            background-color: #111;
            color: #ccc;
        }

        /* Code */
        .markdown-body pre {
            background-color: #111;
            padding: 1em;
            border-radius: 8px;
            overflow: auto;
            font-family: 'Source Code Pro', monospace;
            line-height: 1.4;
        }

        .markdown-body code {
            background-color: #555;
            padding: 0.2em 0.4em;
            border-radius: 4px;
            font-family: 'Source Code Pro', monospace;
        }

        .markdown-body pre code {
            padding: 0;
            background: none;
            color: inherit;
        }

        .markdown-body iframe {
            max-width: 100%;
            min-width: 300px;
            height: auto;
            min-height: 300px;
            border: none;
            border-radius: 8px;
            margin: 1em 0;
        }

        /* Specific Language Styles */
        /* .markdown-body .language-go { color: #00ADD8; }
                    .markdown-body .language-php { color: #4F5D95; }
                    .markdown-body .language-javascript { color: #f1e05a; }
                    .markdown-body .language-kotlin { color: #A97BFF; }
                    .markdown-body .language-swift { color: #FA7343; }
                    .markdown-body .language-elixir { color: #6e4a7e; } */

        /* Keyword Highlighting */
        .markdown-body .hljs-meta {
            color: #4F5D95;
        }

        .markdown-body .hljs-keyword,
        .markdown-body .hljs-built_in {
            color: #d73a49;
        }

        /* Function Names */
        .markdown-body .hljs-function,
        .markdown-body .hljs-type {
            color: #6f42c1;
        }

        /* Comments */
        .markdown-body .hljs-comment {
            color: #6a737d;
            font-style: italic;
        }

        /* Strings */
        .markdown-body .hljs-string {
            color: #178600;
            ;
        }

        /* .markdown-body .hljs-string {
                        color: #89e051;
                    } */

        /* Tables */
        .markdown-body table {
            width: 100%;
            border-collapse: collapse;
            margin: 1em 0;
        }

        .markdown-body th,
        .markdown-body td {
            padding: 0.5em;
            text-align: left;
        }

        .markdown-body th {
            background-color: #555;
            color: #ddd;
            font-weight: 600;
        }

        /* Images */
        .markdown-body img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            display: block;
            margin: 1em 0;
        }

        /* Horizontal Rule */
        .markdown-body hr {
            border: 0;
            height: 1px;
            background: #dadce0;
            margin: 2em 0;
        }

        /* Mermaid Diagrams */
        .markdown-body .mermaid {
            background-color: #e8eaed;
            padding: 1em;
            border-radius: 8px;
            margin: 1em 0;
        }
    </style>
@endsection

@section('scripts')
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.25.0/prism.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.25.0/components/prism-csharp.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.25.0/components/prism-go.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.25.0/components/prism-php.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.25.0/components/prism-javascript.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.25.0/components/prism-kotlin.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.25.0/components/prism-swift.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.25.0/components/prism-bash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.25.0/components/prism-elixir.min.js"></script> --}}
@endsection
