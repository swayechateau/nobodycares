
@extends('layouts.main')
@section('content')
<style>
.post-meta {

}
.post-meta img {
    width: 100%;
    border-radius: 20px;
}

.post-meta h1 {
    font-style: italic;
}
</style>
<section id="post-content">
    <div class="post-meta">
        <img src="{{ $post->hero_image }}" alt="{{ $post->title }}">
        <h1>{{ $post->title }}</h1>
        <p> Author: <span>{{ $post->author }}</span> |
        Creadted: <span>{{ $post->created_at }}</span> |
        Category: <span>{{ $post->category }}</span> |
        Read Time: {{-- <small>{{ $readTime }}</small> --}} </p>
    </div>

    <article class="post markdown-body">
        {!! $content !!}
    </article>
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
    color: #1c1b1f;
    line-height: 1.6;
    padding: 1em;
    background-color: #f5f5f5;
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
    color: #3c4043;
}

.markdown-body h1 { font-size: 2.5em; }
.markdown-body h2 { font-size: 2em; }
.markdown-body h3 { font-size: 1.75em; }
.markdown-body h4 { font-size: 1.5em; }
.markdown-body h5 { font-size: 1.25em; }
.markdown-body h6 { font-size: 1em; }

/* Paragraphs */
.markdown-body p {
    margin: 0.5em 0;
}

/* Links */
.markdown-body a {
    color: #1a73e8;
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
    border-left: 4px solid #dadce0;
    background-color: #e8f0fe;
    color: #202124;
}

/* Code */
.markdown-body pre {
    background-color: #f5f5f5;
    padding: 1em;
    border-radius: 8px;
    overflow: auto;
    font-family: 'Source Code Pro', monospace;
    line-height: 1.4;
}

.markdown-body code {
    background-color: #e8eaed;
    padding: 0.2em 0.4em;
    border-radius: 4px;
    font-family: 'Source Code Pro', monospace;
}

.markdown-body pre code {
    padding: 0;
    background: none;
    color: inherit;
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
.markdown-body .hljs-keyword, .markdown-body .hljs-built_in {
    color: #d73a49;
}

/* Function Names */
.markdown-body .hljs-function, .markdown-body .hljs-type {
    color: #6f42c1;
}

/* Comments */
.markdown-body .hljs-comment{
    color: #6a737d;
    font-style: italic;
}

/* Strings */
.markdown-body .hljs-string {
    color: #178600;;
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
    border: 1px solid #dadce0;
    text-align: left;
}

.markdown-body th {
    background-color: #f1f3f4;
    color: #3c4043;
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