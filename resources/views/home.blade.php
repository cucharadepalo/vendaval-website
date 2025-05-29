@extends('layouts.app')

@section('title', 'Mostra de cinema portugués da Ribeira Sacra')

@section('content')
<main>
	<section id="splash" class="w-full min-h-dvh bg-(--vdl-splash-bg-color) text-(--vdl-splash-txt-color) px-6 py-4">
		{{-- <picture>
			<source media="(orientation: landscape)" srcset="{{ $splash_landscape->getFullUrl() }}">
			<source media="(orientation: portrait)" srcset="{{ $splash_portrait->getFullUrl() }}">
			<img src="{{ $splash_portrait->getFullUrl() }}" alt="{{ $edition->splash_alt_text }}" class="w-full h-auto mx-auto max-w-[1200px] max-h-[1200px]">
		</picture> --}}
		<h1 class="font-sans-condensed text-3xl font-semibold uppercase font-stretch-condenseda">Vendaval</h1>
		<h2>{{ $edition->title }}</h2>
	</section>
</main>

@endsection
