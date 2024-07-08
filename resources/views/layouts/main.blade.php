<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title  ?? 'My Blog'}}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/github-markdown-css/5.6.1/github-markdown.min.css" integrity="sha512-heNHQxAqmr9b5CZSB7/7NSC96qtb9HCeOKomgLFv9VLkH+B3xLgUtP73i1rM8Gpmfaxb7262LFLJaH/hKXyxyA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        body {
            display: flex;
            flex-direction: column;
        }
        main {
            flex: 1;
            padding: 20px;
        }

		@media (prefers-color-scheme: dark) {
			body {
				background-color: #0d1117;
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
</body>
</html>