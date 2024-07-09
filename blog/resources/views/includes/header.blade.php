<style>
    .app-header {
        background-color: #333;
        color: #fff;
        padding: 10px;
        display: flex;
    }
    
    .navigation {
        flex: 1;
        padding: .8rem;
        font-size: 1.5rem;
    }
    
    .navigation a {
        color: #fff;
        text-decoration: none;
        padding: 10px;
    }
    
    .navigation a:hover {
        background-color: #555;
    }
    
    .site-logo {
        font-size: 2rem;
        padding: 7px;
    }
</style>

<header class="app-header">
    <div class="app-logo">
        NC
    </div>
    <nav class="navigation">
        <a href="{{ route('home', app()->getLocale()) }}">Home</a>
        <a href="{{ route('posts.index', app()->getLocale()) }}">Posts</a>
        <a href="{{ route('categories', app()->getLocale()) }}">Categories</a>
    </nav>
    <div class="app-header-right">
        <!-- Language switcher -->
            
        <!-- Theme switcher -->
        @include('includes.theme-switcher')
    </div>
</header>
