<!-- resources/views/posts/index.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - {{ app()->getLocale() }}</title>
</head>
<body>
    <h1>Posts in {{ app()->getLocale() }}</h1>
    <ul>
        @foreach ($posts as $post)
            <li><a href="{{ url(app()->getLocale() . '/posts/' . $post) }}">{{ $post }}</a></li>
        @endforeach
    </ul>
</body>
</html>
