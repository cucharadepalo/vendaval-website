@extends('layouts.app')

@section('title', 'Programa')

@section('content')
	<x-header :$edition
		:$splash
		height="short"
		title="Programa" />

	<main>
		@dd($schedules)
		<section class="w-full px-6 max-w-7xl mx-auto -mt-12">
			<nav role="tablist" class="flex items-center gap-2 justify-start">
				@foreach ($schedules as $date => $item)
					<button id="tab-{{ Str::camel($date) }}"
						aria-selected="{{ $loop->first ? 'true' : 'false' }}"
						aria-controls="panel-{{ Str::camel($date) }}"
						role="tab"
						type="button"
						tabindex="{{ $loop->first ? '0' : '-1' }}"
						class="text-center rounded-sm transition-colors bg-(--vdl-bg-color) text-(--vdl-txt-color) p-3 aria-selected:bg-(--vdl-secondary-color) aria-selected:text-(--vdl-secondary-txt-color)">
							<span class="block uppercase text-xl leading-4">{{ printDDay($date) }}</span>
							<span class="block font-semibold text-5xl leading-none">{{ substr($date, 8, 2) }}</span>
						<span class="block uppercase font-bold text-xl leading-4">{{ printMMonth($date) }}</span>
					</button>
				@endforeach
			</nav>

			@foreach ($schedules as $date => $items)
				<div id="panel-{{ Str::camel($date) }}"
					aria-labelledby="tab-{{ Str::camel($date) }}"
					role="tabpanel"
					tabindex="0"
					class="my-12 grid grid-cols-4 gap-2"
					@if(!$loop->first)hidden @endif>

					@foreach ($items as $hour => $items)
						<div>
							<p class="text-xl font-semibold">{{ $hour }}</p>
						</div>
						<div class="col-span-3">
							@foreach ($items as $item)
							<p class="text-xl font-semibold">{{ $item->description }}</p>
							<p>{{ $item->schedulable->title }}</p>
							@endforeach
						</div>
					@endforeach
				</div>
			@endforeach

		</section>
	</main>
@endsection
