@extends('layouts.app')

@section('title', $page->title)

@section('content')
@if ($edition)
	<x-header
		:$edition
		:$splash
		height="tall"
		third-line="Ribeira Sacra"
		:title="$edition->title" />

	<main class="pb-24">
		<section id="home" class="my-12 px-6 md:px-16 lg:px-8 xl:px-20 xl:my-16">
			@if ($page->content)
				<x-content-wrapper :content="$page->content" />
			@endif
		</section>
		<section id="logos">
		</section>
	</main>
@else
<main class="min-h-dvh flex flex-col items-center justify-center">
	<h1 class="splash-title mega">Vendaval</h1>
	<p class="splash-subtitle simple">Mostra de Cinema Portugués</p>
	<p class="splash-subtitle simple">Ribeira Sacra</p>
	<p class="text-3xl my-16">Próximamente...</p>
</main>
@endif
@endsection
