@extends('layouts.app')

@section('title', $film->title)

@section('content')
	<x-header title="Filmes"
		:$edition
		:$splash
		height="short" />

	<main>
		<section id="info">
			<div class="xl:px-20 xl:pt-16">
				@php
					$still = $film->getFirstMedia('stills');
				@endphp
				@if ($still)
					{{ $still('still_opt')->attributes(['class' => 'w-full h-auto']) }}
				@else
					<img src="{{ Vite::asset('resources/images/still_placeholder.svg') }}" class="w-full h-auto" alt="">
				@endif
			</div>

			<div class="px-6 mt-4 md:px-16 xl:px-20 xl:mt-8 xl:mb-16">
				<h1 class="font-semibold text-3xl xl:text-5xl">{{ $film->title }}</h1>
				<div class="my-4 xl:my-8 xl:text-xl">
					<p class="font-semibold">{{ $film->director }}</p>
					<p>{{ $film->year }} | {{ $film->genre }} | {{ convertToMinutes($film->duration) }}min | {{ $film->country }}</p>
				</div>
				<div class="md-wrapper xl:text-lg xl:columns-2 xl:gap-16 xl:my-8">
					{!! str($film->text)->markdown()->sanitizeHtml() !!}
				</div>
			</div>
		</section>
		<section id="proxeccions" class="w-full py-12 bg-(--vdl-secondary-color) text-(--vdl-secondary-txt-color)">
			<div class="px-6 max-w-6xl mx-auto md:px-16">
				<h2 class="font-semibold text-2xl">Proxeccións</h2>
				@if ($film->schedules->count())
				<ul class="my-4 text-lg">
					@foreach ($film->schedules as $schedule)
					<li>
						<div class="font-semibold uppercase">
							{{ printDDay($schedule->start_time->format('Y-m-d')) }}
							{{ $schedule->start_time->format('d') }}
							{{ printMMonth($schedule->start_time->format('Y-m-d')) }}
							<span class="font-normal lowercase">ás </span>{{ $schedule->start_time->format('H:i') }}
						</div>
						<div>
							<a href="{{ route('where') }}">
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
			</div>
		</section>
	</main>

@endsection
