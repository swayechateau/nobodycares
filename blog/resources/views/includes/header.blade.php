<header class="bg-gray-800 text-white p-2.5 flex items-center justify-between shadow">
    <div class="text-4xl p-1.5"> <!-- Adjusted padding and font size -->
        NC
    </div>
    <nav class="flex-1 flex justify-center">
        <a href="{{ route('home', app()->getLocale()) }}" class="px-3.5 py-2.5 rounded transition-colors duration-300 hover:bg-gray-700">Home</a>
        <a href="{{ route('posts.index', app()->getLocale()) }}" class="px-3.5 py-2.5 rounded transition-colors duration-300 hover:bg-gray-700">Posts</a>
        <a href="https://www.youtube.com/channel/UC-lu2LmQhMo7k0_66pHzH8Q" target="_blank" class="px-3.5 py-2.5 rounded transition-colors duration-300 hover:bg-gray-700">Channel</a>
    </nav>
    <div class="app-header-right">
        <!-- Language switcher -->
        <!-- Theme switcher -->
        {{-- @include('includes.theme-switcher') --}}
    </div>
</header>
