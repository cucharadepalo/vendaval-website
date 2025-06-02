@extends('layouts.app')

@section('title', $page->title)

@section('content')
	<x-header title="{{ $page->title }}"
		:$edition
		:$splash
		height="short" />

	<main>
		@if ($page->content)
			<section class="w-full my-12 px-6 max-w-7xl mx-auto">
				<div class="md-wrapper md:columns-2 md:gap-12 xl:columns-3 space-y-6">
					{!! str($page->content)->markdown()->sanitizeHtml() !!}
				</div>
			</section>
		@endif
		<section class="w-full my-12 px-6 max-w-7xl mx-auto">
			<div class="grid grid-cols-2 gap-4 md:grid-cols-3">
				@foreach ($filmes as $film)
					<article>
						<a href="{{ route('film', ['slug' => $film->slug]) }}" class="h-full flex flex-col">
							<div class="aspect-poster overflow-hidden">
								@if (count($film->getMedia('poster')))
									{{ $film->getMedia('poster')[0]->img()->attributes(['class' => 'w-full h-full object-cover object-center'])->lazy() }}
								@else
									<img src="{{ Vite::asset('resources/images/poster_placeholder.svg') }}" class="w-full h-full object-cover object-center" alt="">
								@endif
							</div>
							<div class="flex-grow flex flex-col">
								<p class="font-semibold my-2 leading-tight md:text-lg">{{ $film->title }}</p>
								<p class="text-sm mt-auto md:text-base">{{ $film->director }}</p>
								<p class="text-sm md:text-base">{{ $film->year }}</p>
							</div>
						</a>
					</article>
				@endforeach
			</div>
		</section>
	</main>

@endsection
