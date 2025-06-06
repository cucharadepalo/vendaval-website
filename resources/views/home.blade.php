@extends('layouts.app')

@section('title', $page->title)

@section('content')
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
@endsection
