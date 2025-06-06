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
				<x-content-wrapper :content="$activity->text" />
			</div>
		</section>
		@if ($activity->schedules->count())
		<section id="proxeccions" class="w-full py-12 bg-(--vdl-secondary-color) text-(--vdl-secondary-txt-color)">
			<div class="px-6 max-w-7xl mx-auto">
				<h2 class="font-semibold text-2xl">{{ $activity->title }}</h2>
				<ul class="my-4 text-lg">
					@foreach ($activity->schedules as $schedule)
					<li>
						<div class="font-semibold uppercase">
							{{ printDDay($schedule->start_time->format('Y-m-d')) }}
							{{ $schedule->start_time->format('d') }}
							{{ printMMonth($schedule->start_time->format('Y-m-d')) }}
							<span class="font-normal lowercase">ás </span>{{ $schedule->start_time->format('H:i') }}
						</div>
						<div>
							<x-filament::icon icon="bx-map" class="w-6 h-6 inline-block align-text-bottom"/> {{ $schedule->venue->name }}
						</div>
					</li>
					@endforeach
				</ul>
				<nav class="mt-12 flex flex-col">
					<a href="{{ route('schedule') }}" class="text-lg inline-block">&larr; Programa</a>
				</nav>
			</div>
		</section>
		@endif
	</main>

@endsection
