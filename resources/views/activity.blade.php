@extends('layouts.app')

@section('title', $activity->title)

@section('content')
	<x-header title="Filmes"
		:$edition
		:$splash
		height="short" />

	<main>
		<section>
			<div class="md:px-16 md:pt-8 lg:px-8 xl:px-20 xl:pt-12">
				@php
					$image = $activity->getFirstMedia('image');
				@endphp
				@if ($image)
					{{ $image('image_opt')->attributes(['class' => 'w-full h-auto']) }}
				@else
					<img src="{{ Vite::asset('resources/images/still_placeholder.svg') }}" class="w-full h-auto" alt="">
				@endif
			</div>

			<div class="px-6 my-6 md:px-16 lg:px-8 xl:px-20 xl:my-12">
				<div class="lg:grid lg:grid-cols-5 lg:gap-12">
					<div class="lg:col-span-2">
						<h1 class="font-semibold text-3xl xl:text-5xl">{{ $activity->title }}</h1>
					</div>
					<div class="lg:col-span-3">
						<x-content-wrapper :content="$activity->summary" class="my-6 lg:mt-0 lg:text-lg xl:text-xl" />
						<x-content-wrapper :content="$activity->text" no-cols="true" class="lg:text-lg xl:text-xl" />
					</div>
				</div>
			</div>
		</section>

		@if ($activity->schedules->count())
		<section class="py-12 bg-(--vdl-secondary-color) text-(--vdl-secondary-txt-color) px-6 md:px-16 lg:px-8 xl:px-20">
			<h2 class="font-semibold text-2xl">{{ $activity->title }}</h2>
			@if ($activity->schedules->count())
				<ul class="my-4 text-lg xl:my-8 md:grid md:grid-cols-2 md:gap-8 md:items-center lg:grid-cols-3">
					@foreach ($activity->schedules as $schedule)
					<li>
						<div class="font-semibold uppercase">
							{{ printDDay($schedule->start_time->format('Y-m-d')) }}
							{{ $schedule->start_time->format('d') }}
							{{ printMMonth($schedule->start_time->format('Y-m-d')) }}
							<span class="font-normal lowercase">ás </span>{{ $schedule->start_time->format('H:i') }}
						</div>
						<div>
							<a href="{{ route('where') }}" class="inline-block py-2 rounded-md hover:bg-white/10 hover:px-6 transition-all">
								<x-filament::icon icon="bx-map" class="w-6 h-6 inline-block align-text-bottom" /> {{ $schedule->venue->name }}
							</a>
						</div>
					</li>
					@endforeach
				</ul>
			@endif
			<nav class="mt-12 flex flex-col">
				<a href="{{ route('schedule') }}" class="text-lg inline-block">&larr; Programa</a>
			</nav>
		</section>
		@endif
	</main>

@endsection
