@extends('layouts.app')

@section('title', $film->title)

@section('content')
	<x-header title="Filmes"
		:$edition
		:$splash
		height="short" />

	<main>
		<section class="w-full mb-12 max-w-7xl mx-auto">
			@php
				$still = $film->getFirstMedia('stills');
			@endphp
			@if ($still)
				{{ $still('still_opt')->attributes(['class' => 'w-full h-auto']) }}
			@else
				<img src="{{ Vite::asset('resources/images/still_placeholder.svg') }}" class="w-full h-auto" alt="">
			@endif

			<div class="px-6 mt-4">
				<h1 class="font-semibold text-3xl">{{ $film->title }}</h1>
				<div class="my-4">
					<p class="font-semibold">{{ $film->director }}</p>
					<p>{{ $film->year }} | {{ $film->genre }} | {{ convertToMinutes($film->duration) }}min | {{ $film->country }}</p>
				</div>
				<div class="md-wrapper">
					{!! str($film->text)->markdown()->sanitizeHtml() !!}
				</div>
			</div>
		</section>
	</main>

@endsection
