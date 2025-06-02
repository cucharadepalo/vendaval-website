@extends('layouts.app')

@section('title', 'Mostra de cinema portugués da Ribeira Sacra')

@section('content')
	<x-header :$edition
		:$splash
		height="tall"
		third-line="Ribeira Sacra"
		:title="$edition->title" />

	<main>
		<section class="text-lg text-gray-950 text-pretty my-16 xl:my-24">
			<div class="w-full px-6 max-w-7xl mx-auto">
				<div class="md-wrapper md:columns-2 md:gap-12 xl:columns-3 space-y-6">
					{!! str($page->content)->markdown()->sanitizeHtml() !!}
				</div>
			</div>
		</section>
	</main>
@endsection
