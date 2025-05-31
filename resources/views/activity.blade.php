@extends('layouts.app')

@section('title', $activity->title)

@section('content')
	<x-header title="Filmes"
		:$edition
		:$splash
		height="short" />

	<main>
		<section class="w-full mb-12 max-w-7xl mx-auto">
			@php
				$image = $activity->getFirstMedia('image');
			@endphp
			@if ($image)
				{{ $image('image_opt')->attributes(['class' => 'w-full h-auto']) }}
			@else
				<img src="{{ Vite::asset('resources/images/still_placeholder.svg') }}" class="w-full h-auto" alt="">
			@endif

			<div class="px-6 mt-4">
				<h1 class="font-semibold text-3xl">{{ $activity->title }}</h1>
				<div class="my-4">
					{!! str($activity->summary)->markdown()->sanitizeHtml() !!}
				</div>
				<div class="md-wrapper">
					{!! str($activity->text)->markdown()->sanitizeHtml() !!}
				</div>
			</div>
		</section>
	</main>

@endsection
