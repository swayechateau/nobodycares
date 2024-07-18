
<style>
    .app-header {
        background-color: #333;
        color: #fff;
        padding: 10px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .app-logo {
        font-size: 2rem;
        padding: 7px;
    }
    
    .navigation {
        flex: 1;
        display: flex;
        justify-content: center;
    }
    
    .navigation a {
        color: #fff;
        text-decoration: none;
        padding: 10px 15px;
        border-radius: 5px;
        transition: background-color 0.3s;
    }
    
    .navigation a:hover {
        background-color: #555;
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
