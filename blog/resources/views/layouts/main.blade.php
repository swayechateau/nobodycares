<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title  ?? 'My Blog'}}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    @yield('styles')
    <style>
        * {
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        body {
            display: flex;
            flex-direction: column;
        }
        a {
            text-decoration: none;
            color: initial;
        }
        a:hover {
            text-decoration: none;
        }
        img {
            width: 100%;
        }
        main {
            flex: 1;
            padding: 20px;
        }

		@media (prefers-color-scheme: dark) {
			body {
				background-color: #0d1117;
                color: #c9d1d9;
			}
		} 
	</style>
</head>
<body>
    @include('includes.header')
    <main>
    @yield('content')
    </main>
    @include('includes.footer')
    @yield('scripts')
</body>
</html>