@extends('layouts.app')

@section('title', 'Filmes')

@section('content')
	<x-header title="Filmes"
		:$edition
		:$splash
		height="short" />

	<main>
		<section class="w-full px-6 max-w-7xl mx-auto">
			<div class="grid grid-cols-2 gap-2">
				@foreach ($filmes as $film)
					<article>
						<a href="{{ route('film', ['slug' => $film->slug]) }}" class="flex flex-col">
							<div class="aspect-poster overflow-hidden">
								@if (count($film->getMedia('poster')))
									{{ $film->getMedia('poster')[0]->img()->attributes(['class' => 'w-full h-full object-cover object-center'])->lazy() }}
								@else
									Placeholder
								@endif
							</div>
							<div class="flex-grow flex flex-col">
								<p class="font-semibold mt-2 leading-tight">{{ $film->title }}</p>
								<p class="text-sm mt-auto">{{ $film->director }}</p>
								<p class="text-sm">{{ $film->year }}</p>
							</div>
						</a>
					</article>
				@endforeach
			</div>
		</section>
	</main>

@endsection
