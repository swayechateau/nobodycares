@extends('layouts.main')

@section('content')
    <div class="container mx-auto">
        <section id="hero" class="relative h-[300px] w-full bg-cover bg-center rounded-br-[200px]"
            style="background-image: url('https://swayechateau.com/media/image/anime-girl-futuristic-city-computer-short-hair-coffee-25464.jpeg');">
            <div class="absolute inset-0 bg-black h-full w-full bg-opacity-50 rounded-br-[200px]"></div>
            <div class="flex h-full items-center justify-center p-3 z-10 relative">
                <div class="text-center">
                    <div class="text-xl font-light text-white text-shadow">
                        <form id="post-serach" action="{{ url(app()->getLocale() . '/posts/') }}" method="GET"
                            class="flex items-center">
                            <input id="search-input" type="text"
                                class="flex-1 p-2 bg-gray-800 text-gray-100 rounded-l focus:outline-none"
                                placeholder="Search posts" name="search" value="{{ $query }}">
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-r">
                                Search
                            </button>
                        </form>
                        <script>
                            document.getElementById('search-input').addEventListener('input', function(e) {
                                const form = document.getElementById('post-search');
                                const searchValue = e.target.value;
                                // Fetch data as the user types
                                fetchData(searchValue);
                            });

                            document.getElementById('post-search').addEventListener('submit', function(e) {
                                e.preventDefault();
                                const searchValue = document.getElementById('search-input').value;
                                // Fetch data when submitting the form
                                fetchData(searchValue);
                            });

                            function fetchData(search) {
                                fetch(`{{ url('/search?query=') }}${search}`, {
                                        method: 'GET',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'Accept': 'application/json'
                                        }
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        console.log(data); // Log the fetched data
                                        // Update the query string parameter
                                        updateQueryStringParameter('search', search, data.title);
                                        // Update the posts section with the fetched data
                                        updatePosts(data.results);

                                    })
                                    .catch(error => console.error('Error fetching data:', error));
                            }

                            function updateQueryStringParameter(key, value, title) {
                                const url = new URL(window.location.href);
                                const params = url.searchParams;

                                if (value === null || value === undefined) {
                                    params.delete(key); // Remove the parameter if the value is null or undefined
                                } else {
                                    params.set(key, value); // Set or update the parameter
                                }
                                // Update page title
                                document.title = title;
                                // Rebuild the URL and push update to history
                                window.history.pushState({}, title, url);
                            }

                            function updatePosts(posts) {
                                // Update the posts section with the fetched data
                                const postsSection = document.getElementById('posts');
                                postsSection.innerHTML = '';
                                posts.forEach(post => {
                                    const postElement = document.createElement('div');
                                    postElement.classList.add('hover:bg-[#333]', 'group', 'rounded-lg', 'p-2.5', 'md:first:col-span-2',
                                        'lg:first:col-span-1', 'xl:first:col-span-2', 'overflow-hidden', 'hover:animate-pulse',
                                        'delay-75', 'transition', 'duration-150', 'ease-in-out');
                                    postElement.innerHTML = `
                                    <a class="h-full flex flex-col" href="${post.full_url}">
                                        <div class="overflow-hidden">
                                            <img src="${post.hero_image}" alt="${post.title}"
                                                class="rounded-t-lg lg:min-h-[300px] group-odd:rounded-br-[300px] group-even:rounded-bl-[300px]">
                                        </div>
                                        <div class="grow p-2.5">
                                            <div class="flex justify-end mb-2.5">
                                                <div class="bg-purple-800 text-white px-2.5 py-1 rounded-full">${post.category}</div>
                                            </div>
                                            <h3 class="pt-6 pb-4 text-lg font-semibold">${post.title}</h3>
                                            <p>${post.excerpt}</p>
                                        </div>
                                        <div class="border-t border-gray-300 p-2.5 text-center">
                                            <small>By ${post.author}</small>
                                        </div>
                                    </a>
                                `;
                                    postsSection.appendChild(postElement);
                                });

                            }
                        </script>
                    </div>
                    <div class="uppercase p-4 mb-4 text-shadow text-white w-full">
                        @foreach ($categories as $category)
                            <a href="{{ url(app()->getLocale() . '/posts?search=' . $category) }}"
                                class="bg-gray-800 hover:bg-gray-900 text-white font-bold py-2 px-4 rounded-full mr-2">
                                {{ $category }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        <section id="posts"
            class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5 justify-center p-8 lg:container mx-auto">
            @foreach ($posts as $post)
                <div
                    class="hover:bg-gray-800 rounded-lg p-2.5 md:first:col-span-2 lg:first:col-span-1 xl:first:col-span-2 overflow-hidden hover:animate-pulse delay-75 transition duration-150 ease-in-out group">
                    <a class="h-full flex flex-col" href="{{ url(app()->getLocale() . '/posts/' . $post['slug']) }}">
                        <div class="overflow-hidden">
                            <img src="{{ $post['hero_image'] }}" alt="{{ $post['title'] }}"
                                class="rounded-t-lg lg:min-h-[300px] group-odd:rounded-br-[300px] group-even:rounded-bl-[300px]">
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
    </div>
@stop
