@extends('layouts.main')
@section('content')
<style>

    section {
        margin: 20px 0;
        padding: 20px 10px;
    }
    .posts-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
        gap: 20px;
    }
    .posts-card {
        border: 1px solid #ccc;
        padding: 10px;
        border-radius: 10px;
        overflow: hidden;
    }
    .posts-card-image {
        margin-top: -10px;
        margin-left: -10px;
        margin-right: -10px;
        overflow: hidden;
    }
    .posts-card-image img{
        border-top-right-radius: 9px;
        border-top-left-radius: 9px;
        border-bottom-right-radius: 1px;
        border-bottom-left-radius: 30px;
    }
    .posts-card-body {
        padding: 10px;
    }
    .posts-card-footer {
        border-top: 1px solid #ccc;
        padding: 10px;
        text-align: center;
    }
    .text-right {
        text-align: right;
    }
    .mb-10 {
        margin-bottom: 10px;
    }
    .pill {
        background-color: #333;
        color: #fff;
        padding: 5px 10px;
        border-radius: 20px;
        display: inline-block;
    }
    </style>
        <section id="hero">
            <h1>Welcome to NobodyCares</h1>
            <h4>Where nobody cares about your path of failures to success.</h4>
        </section>

        <section id="featured-posts">
            <h2>Featured Posts</h2>
            <!-- Grid layout of featured posts -->
            <div class="posts-grid"> 
                @foreach ($featuredPosts as $post)
                <div class="posts-card">
                    <a href="{{ url(app()->getLocale() . '/posts/' . $post['slug']) }}">
                        <div class="posts-card-image">
                            <img src="{{$post['hero_image']}}" alt="{{$post['title']}}">
                        </div>
                        <div class="posts-card-body">
                            <div class="text-right mb-10">
                                <div class="pill">{{$post['category']}}</div>
                            </div>
                            <h3>{{$post['title']}}</h3>
                            <p>{{$post['excerpt']}}</p>
                        </div>
                        <div class="posts-card-footer">
                            <small>By {{$post['author']}}</small>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </section>
        <section id="recent-posts">
            <h2>Recent Posts</h2>
            <!-- List or grid of recent posts -->
            <div class="posts-grid"> 
                @foreach ($posts as $post)
                <div class="posts-card">
                <a href="{{ url(app()->getLocale() . '/posts/' . $post['slug']) }}">
                    
                    <div class="posts-card-image">
                        <img src="{{$post['hero_image']}}" alt="{{$post['title']}}">
                    </div>
                    <div class="posts-card-body">
                        <div class="text-right mb-10">
                            <div class="pill">{{$post['category']}}</div>
                        </div>
                        <h3>{{$post['title']}}</h3>
                        <p>{{$post['excerpt']}}</p>
                    </div>
                    <div class="posts-card-footer">
                        <small>By {{$post['author']}}</small>
                    </div>
                </a>
                </div>
                @endforeach
            </div>
        </section>
        <section id="featured-categories">
            <h2>Featured Categories</h2>
            <!-- List of featured categories -->
        </section>
@endsection
