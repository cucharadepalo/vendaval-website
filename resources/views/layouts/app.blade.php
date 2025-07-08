<!DOCTYPE html>
<html lang="gl" class="bg-(--vdl-txt-color)" class="bg-(--vdl-txt-color)">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Vendaval &ndash; @yield('title')</title>
	<link rel="preload" href="https://use.typekit.net/kdg6lzn.css" as="style">
	<link rel="preconnect" href="https://fonts.bunny.net">
	<link rel="preconnect" href="https://fonts.bunny.net">
	<link href="https://use.typekit.net/kdg6lzn.css" rel="stylesheet">
	<link href="https://fonts.bunny.net/css?family=ibm-plex-sans:400,400i,600,600i" rel="stylesheet">
	{{ Vite::useBuildDirectory('build') }}

	@if (config('app.env') == 'local')
	@vite(['resources/css/app.css', 'resources/js/app.js'])
	@else
	<link href="{{ Vite::asset('resources/css/app.css') }}" rel="stylesheet">
	<script src="{{ Vite::asset('resources/js/app.js') }}" defer></script>
	@endif

	{!! printCssVariables($edition ? $edition->colors : config('custom.edition.default_colors')) !!}
</head>
<body class="bg-(--vdl-bg-color) text-(--vdl-txt-color) max-w-7xl mx-auto min-h-dvh">
@yield('content')

@include('footer')
</body>
</html>
