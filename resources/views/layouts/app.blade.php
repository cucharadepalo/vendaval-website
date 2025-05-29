<!DOCTYPE html>
<html lang="gl">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Vendaval &ndash; @yield('title')</title>
	<link rel="preconnect" href="https://fonts.bunny.net">
	<link rel="preload" href="https://use.typekit.net/kdg6lzn.css" as="style">
	<link href="https://use.typekit.net/kdg6lzn.css" rel="stylesheet">
	<link href="https://fonts.bunny.net/css?family=ibm-plex-sans|ibm-plex-sans-condensed" rel="stylesheet">
	<link href="{{ Vite::asset('resources/css/app.css') }}" rel="stylesheet">

	{!! printCssVariables($edition->colors) !!}
</head>
<body class="bg-(--vdl-bg-color) text-(--vdl-txt-color)">
@yield('content')
</body>
</html>
