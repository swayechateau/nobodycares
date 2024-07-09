
@extends('layouts.main')
@section('content')

<section id="post-content">
    <article class="post markdown-body">
        {!! $content !!}
    </article>
</section>
<section id="suggested-posts">
    <h2>Suggested Posts</h2>
    <!-- List of related posts -->
</section>

@stop
