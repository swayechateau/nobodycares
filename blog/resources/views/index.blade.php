@extends('layouts.main')
@section('content')
<style>
    a {
        text-decoration: none;
        color: initial;
    }
    img {
        width: 100%;
    }
    section {
        margin: 20px 0;
        padding: 20px 10px;
    }
    .posts-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
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
                <a href="#" class="posts-card">
                    <div class="posts-card-image">
                        <img src="https://via.placeholder.com/150" alt="Post Image">
                    </div>
                    <div class="posts-card-body">
                        <div class="text-right mb-10">
                            <div class="pill">Category</div>
                        </div>
                        <h3>100 Mistakes in Go</h3>
                        <p>Part 1 in the 100 Mistakes of Go seriese</p>
                    </div>
                    <div class="posts-card-footer">
                        <small>By NobodyCares</small>
                    </div>
                </a>
                <div class="posts-card">
                    <img src="https://via.placeholder.com/150" alt="Post Image">
                    <h3>Post Title</h3>
                    <p>Post Excerpt</p>
                    <a href="#">Read More</a>
                </div>
                <div class="posts-card">
                    <img src="https://via.placeholder.com/150" alt="Post Image">
                    <h3>Post Title</h3>
                    <p>Post Excerpt</p>
                    Read More</a>
                </div>
            </div>
        </section>
        <section id="recent-posts">
            <h2>Recent Posts</h2>
            <!-- List or grid of recent posts -->
        </section>
        <section id="featured-categories">
            <h2>Featured Categories</h2>
            <!-- List of featured categories -->
        </section>
@endsection
