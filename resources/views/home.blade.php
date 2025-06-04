@extends('layouts.app')

@section('title', $page->title)

@section('content')
	<x-header :$edition
		:$splash
		height="tall"
		third-line="Ribeira Sacra"
		:title="$edition->title" />

	<main>
		<section id="home" class="my-12 px-6 md:px-16 xl:px-20 xl:my-16">
			@if ($page->content)
				<div class="md-wrapper lg:text-lg lg:columns-2 lg:gap-16 lg:my-8">
					{!! str($page->content)->markdown()->sanitizeHtml() !!}
				</div>
			@endif
		</section>
		<section id="logos">

		</section>
	</main>
@endsection
