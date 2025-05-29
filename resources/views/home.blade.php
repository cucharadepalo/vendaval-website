@extends('layouts.app')

@section('title', 'Mostra de cinema portugués da Ribeira Sacra')

@section('content')
<main>
	<section id="splash" class="w-full min-h-dvh bg-(--vdl-splash-bg-color) text-(--vdl-splash-txt-color)">
		<picture>
			<source media="(orientation: landscape)" srcset="{{ $splash_landscape->getFullUrl() }}">
			<source media="(orientation: portrait)" srcset="{{ $splash_portrait->getFullUrl() }}">
			<img src="{{ $splash_portrait->getFullUrl() }}" alt="{{ $edition->splash_alt_text }}" class="w-full h-auto mx-auto max-w-[1200px] max-h-[1200px]">
		</picture>
		<div class="px-6 py-4 text-center absolute top-0 left-0 right-0">
			<h1 class="splash-title">Vendaval</h1>
			<h2 class="splash-subtitle">{{ $edition->title }}</h2>
		</div>
	</section>
</main>

@endsection
