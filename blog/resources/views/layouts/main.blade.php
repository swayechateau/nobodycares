<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title  ?? 'My Blog'}}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    @yield('styles')
    <style>
		@media (prefers-color-scheme: dark) {
			body {
				background-color: #0d1117;
                color: #c9d1d9;
			}
		} 
	</style>
</head>
<body class="flex flex-col bg-[#0d1117] text-[#c9d1d9]">
    @include('includes.header')
    <main class="grow">
    @yield('content')
    </main>
    @include('includes.footer')
    @yield('scripts')
</body>
</html>