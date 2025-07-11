@extends('layouts.app')

@section('title', $page->title)

@section('content')
	<x-header title="{{ $page->title }}"
		:$edition
		:$splash
		height="short" />

	<main>
		@if ($page->content)
			<section class="my-12 px-6 md:px-16 lg:px-8 xl:px-20 xl:my-16">
				<x-content-wrapper :content="$page->content" class="lg:text-lg xl:text-xl" />
			</section>
		@endif
		<section class="mt-12 px-6 pb-12 md:px-16 lg:px-8 xl:px-20 xl:mt-16">
			<div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4 lg:gap-8">
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
								<p class="font-semibold my-2 leading-tight md:text-lg xl:text-2xl xl:mt-4">{{ $film->title }}</p>
								<p class="text-sm mt-auto md:text-base xl:text-lg">{{ $film->director }}</p>
								<p class="text-sm md:text-base xl:text-lg">{{ $film->year }}</p>
							</div>
						</a>
					</article>
				@endforeach
			</div>
		</section>
	</main>

@endsection
