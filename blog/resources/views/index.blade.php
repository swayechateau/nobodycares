@extends('layouts.main')

@section('meta')
    <meta name="description" content="Welcome to NobodyCares. Etching my journey, One post at a time">
    <meta name="keywords" content="blog, posts, articles, web development, programming, technology">
    <meta name="author" content="NobodyCares">
    <meta property="og:title" content="NobodyCares">
    <meta property="og:description" content="Welcome to NobodyCares. Etching my journey, One post at a time">
    <meta property="og:image" content="{{ asset('img/site_hero.webp') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="NobodyCares">
    <meta name="twitter:description" content="Welcome to NobodyCares. Etching my journey, One post at a time">
    <meta name="twitter:image" content="{{ asset('img/site_hero.webp') }}">
@endsection

@section('content')
    <!-- Hero Section -->
    <section id="hero" class="relative h-[400px] w-full bg-cover bg-center rounded-bl-[200px]"
        style="background-image: url('{{asset("/img/site_hero.webp")}}');">
        <style>
            .text-shadow {
                text-shadow: 2px 2px #000;
            }
        </style>
        <div class="absolute inset-0 bg-black h-full w-full bg-opacity-50 rounded-bl-[200px]"></div>
        <div class="flex h-full items-center justify-center p-3 z-10 relative">
            <div class="text-center">
                <h1 class="text-5xl font-light text-gray-200 text-shadow">
                    Welcome to NobodyCares
                </h1>
                <div class="uppercase pl-2 mb-4 text-shadow text-white">
                    Etching my journey, One post at a time
                </div>
                <a href="{{ url(app()->getLocale() . '/posts/') }}"
                    class="bg-gray-800 hover:bg-gray-500 text-gray-200 font-bold py-2 px-4 rounded-full">
                    View All Posts
                </a>
            </div>

        </div>

    </section>
    <div class="container mx-auto">
        <!-- Featured Posts Section -->
        <section id="featured-posts" class="my-5 py-5 px-2.5">
            <h2 class="text-center text-4xl mb-6 capitalize">Featured Posts</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach ($featuredPosts as $post)
                    <div class="p-2.5 overflow-hidden hover:bg-gray-800 hover:animate-subtle-bounce rounded-lg">
                        <a href="{{ url(app()->getLocale() . '/posts/' . $post['slug']) }}">
                            <div class="overflow-hidden">
                                <img src="{{ $post['hero_image'] }}" alt="{{ $post['title'] }}"
                                    class="rounded-t-lg rounded-br-[300px]">
                            </div>
                            <div class="p-2.5">
                                <div class="flex justify-end mb-2.5">
                                    <div class="bg-gray-800 text-white px-2.5 py-1 rounded-full">{{ $post['category'] }}
                                    </div>
                                </div>
                                <h3 class="pt-6 pb-4 text-xl font-semibold">{{ $post['title'] }}</h3>
                                <p class="mb-4 text-lg">{{ $post['excerpt'] }}</p>
                            </div>
                            <div class="border-t border-gray-300 p-2.5 text-center">
                                <small>By {{ $post['author'] }}</small>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- Recent Posts Section -->
        <section id="recent-posts" class="my-5 py-5 px-2.5">
            <h2 class="text-center text-4xl mb-6 capitalize">Recent Posts</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach ($posts as $post)
                    <div class="p-2.5 overflow-hidden hover:bg-gray-800 hover:animate-subtle-bounce rounded-lg">
                        <a href="{{ url(app()->getLocale() . '/posts/' . $post['slug']) }}">
                            <div class="overflow-hidden">
                                <img src="{{ $post['hero_image'] }}" alt="{{ $post['title'] }}"
                                    class="rounded-t-lg rounded-br-[300px]">
                            </div>
                            <div class="p-2.5">
                                <div class="flex justify-end mb-2.5">
                                    <div class="bg-gray-800 text-white px-2.5 py-1 rounded-full">{{ $post['category'] }}
                                    </div>
                                </div>
                                <h3 class="pt-6 pb-4 text-xl font-semibold">{{ $post['title'] }}</h3>
                                <p class="mb-4 text-lg">{{ $post['excerpt'] }}</p>
                            </div>
                            <div class="border-t border-gray-300 p-2.5 text-center">
                                <small>By {{ $post['author'] }}</small>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </section>

        {{-- <!-- Featured Categories Section -->
    <section id="featured-videos" class="my-5 py-5 px-2.5">
        <h2 class="text-center text-4xl mb-6 capitalize">Featured Videos</h2>
        <!-- List of featured categories -->
    </section> --}}
    </div>
@endsection
