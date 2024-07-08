<!-- resources/views/posts/show.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <meta name="color-scheme" content="light dark">
	<link rel="stylesheet" href="github-markdown.css">
	<style>
		body {
			box-sizing: border-box;
			min-width: 200px;
			max-width: 980px;
			margin: 0 auto;
			padding: 45px;
		}

		@media (prefers-color-scheme: dark) {
			body {
				background-color: #0d1117;
			}
		}
	</style>
    <!-- <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .navigation {
            display: flex;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            width: 100%;
            background: rgba(0,0,0,.5);
            padding: 1rem;
            height: 3em;
        }

        .navigation a {
            color: #fff;
            text-decoration: none;
        }

        .navigation a:hover {
            color: #f0f0f0;
        }

        .post {
            padding: 2rem;
        }
        .post h1 {
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        footer {
            background-color: #333;
            color: #fff;
            padding: 1rem;
            text-align: center;
            font-size: 1.4rem;
        }
    </style> -->
</head>
<body>
    <nav class="navigation">
        <a href="{{ route('posts.index', app()->getLocale()) }}">Posts</a>
    </nav>
    <main>
        <article class="post">
            {!! $content !!}
        </article>
    </main>
    <footer>
        <small>&copy; {{ date('Y') }} My Blog</small>
    </footer>
</body>
</html>
