@extends('layouts.main')

@section('content')

    <section id="hero" class="relative h-[300px] w-full bg-cover bg-center rounded-br-[200px]"
        style="background-image: url('https://swayechateau.com/media/image/anime-girl-futuristic-city-computer-short-hair-coffee-25464.jpeg');">
        <div class="absolute inset-0 bg-black h-full w-full bg-opacity-50 rounded-br-[200px]"></div>
        <div class="flex h-full items-center justify-center p-3 z-10 relative">
            <div class="text-center">
                <div class="text-xl font-light text-white text-shadow">
                    categories
                </div>
                <div class="uppercase pl-2 mb-4 text-shadow text-white w-full">
                    <input type="text" class="w-full p-2 bg-gray-800 text-gray-100 rounded focus:outline-none"
                        placeholder="Search">
                </div>
            </div>
        </div>
    </section>
    <section class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5 justify-center p-8 lg:container mx-auto">
        @foreach ($posts as $post)
            <div
                class="border border-[#333] p-2.5 rounded-lg md:first:col-span-2 lg:first:col-span-1 xl:first:col-span-2 overflow-hidden bg-[#333] shadow transition-shadow duration-300 hover:shadow-md">
                <a class="h-full flex flex-col" href="{{ url(app()->getLocale() . '/posts/' . $post['slug']) }}">
                    <div class="overflow-hidden">
                        <img src="{{ $post['hero_image'] }}" alt="{{ $post['title'] }}"
                            class="rounded-t-lg rounded-bl-[300px] lg:min-h-[300px]">
                    </div>
                    <div class="grow p-2.5">
                        <div class="flex justify-end mb-2.5">
                            <div class="bg-purple-800 text-white px-2.5 py-1 rounded-full">{{ $post['category'] }}</div>
                        </div>
                        <h3 class="pt-6 pb-4 text-lg font-semibold">{{ $post['title'] }}</h3>
                        <p>{{ $post['excerpt'] }}</p>
                    </div>
                    <div class="border-t border-gray-300 p-2.5 text-center">
                        <small>By {{ $post['author'] }}</small>
                    </div>
                </a>
            </div>
        @endforeach
    </section>

@stop
