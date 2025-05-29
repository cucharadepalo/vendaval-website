<!DOCTYPE html>
<html lang="gl">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Vendaval &ndash; @yield('title')</title>
	<link rel="preconnect" href="https://fonts.bunny.net">
	<link href="https://fonts.bunny.net/css?family=ibm-plex-sans|ibm-plex-sans-condensed" rel="stylesheet">
	@vite(['resources/css/app.css', 'resources/js/app.js'])
	@if ($edition && $edition->colors)
		<style>
			:root {
				@foreach ($edition->colors as $color)
					{{ $color['variable'] }}: {{ $color['color'] }};
				@endforeach
			}
		</style>
	@endif
</head>
<body class="bg-zinc-200">
	@yield('content')
</body>
</html>
