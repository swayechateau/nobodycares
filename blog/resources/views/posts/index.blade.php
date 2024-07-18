@extends('layouts.main')
@section('content')
<style>
    .posts-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
    }
    .posts-card {
        border: 1px solid #ccc;
        padding: 10px;
        border-radius: 10px;
        overflow: hidden;
        background-color: #fff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        transition: box-shadow 0.3s;
    }

    .posts-card:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
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
    background-color: #6200ea;
    color: #fff;
    padding: 5px 10px;
    border-radius: 20px;
    display: inline-block;
}

</style>
    <section class="posts-grid">
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
    </section>
    
@stop
