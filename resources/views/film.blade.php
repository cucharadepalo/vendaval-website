@extends('layouts.app')

@section('title', 'Filmes – ' . $film->title)

@section('content')
	<x-header title="Filmes"
		:$edition
		:$splash
		height="short" />

	<main>
		<section>
			<div class="md:px-16 md:pt-8 lg:px-8 xl:px-20 xl:pt-12">
				@php
					$still = $film->getFirstMedia('stills');
				@endphp
				@if ($still)
					{{ $still('still_opt')->attributes(['class' => 'w-full h-auto']) }}
				@else
					<img src="{{ Vite::asset('resources/images/still_placeholder.svg') }}" class="w-full h-auto" alt="">
				@endif
			</div>
			<div class="px-6 my-6 md:px-16 lg:px-8 xl:px-20 xl:my-12">
				<div class="lg:grid lg:grid-cols-5 lg:gap-12">
					<div class="lg:col-span-2">
						<h1 class="font-semibold text-3xl xl:text-5xl">{{ $film->title }}</h1>
						<div class="my-6 xl:text-xl xl:mb-12">
							<p class="font-semibold xl:text-2xl">{{ $film->director }}</p>
							<p>{{ $film->year }} {{ $film->genre ? '| ' . $film->genre : '' }} {{ $film->duration ? '| ' . convertToMinutes($film->duration) . 'min' : '' }} {{ $film->country ? '| ' . $film->country : '' }}</p>
							@if ($film->version)
							<p class="text-sm xl:text-base italic">{{ $film->version }}</p>
							@endif
						</div>
					</div>
					<x-content-wrapper :content="$film->text" no-cols="true" class="lg:col-span-3 lg:text-lg xl:text-xl" />
				</div>
			</div>
		</section>

		<section class="py-12 bg-(--vdl-secondary-color) text-(--vdl-secondary-txt-color) px-6 md:px-16 lg:px-8 xl:px-20">
			<h2 class="font-semibold text-2xl">Proxeccións</h2>
			@if ($film->schedules->count())
			<ul class="my-4 text-lg xl:my-8 md:grid md:grid-cols-2 md:gap-8 md:items-center lg:grid-cols-3">
				@foreach ($film->schedules as $schedule)
				<li>
					<div class="font-semibold uppercase">
						{{ printDDay($schedule->start_time->format('Y-m-d')) }}
						{{ $schedule->start_time->format('d') }}
						{{ printMMonth($schedule->start_time->format('Y-m-d')) }}
						<span class="font-normal lowercase">ás </span>{{ $schedule->start_time->format('H:i') }}
					</div>
					<div>
						<a href="{{ route('where') }}" class="inline-block py-2 rounded-md hover:bg-white/10 hover:px-6 transition-all">
							<x-filament::icon icon="bx-map" class="w-6 h-6 inline-block align-text-bottom"/> {{ $schedule->venue->name }}
						</a>
					</div>
				</li>
				@endforeach
			</ul>
			@else
			<p class="text-lg my-4">Próximamente.</p>
			@endif
			<nav class="mt-12 flex flex-col">
				<a href="{{ route('filmes') }}" class="text-lg inline-block">&larr; Filmes</a>
				<a href="{{ route('schedule') }}" class="text-lg inline-block">&larr; Programa</a>
			</nav>
		</section>
	</main>

@endsection
