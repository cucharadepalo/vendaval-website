@extends('layouts.app')

@section('title', 'Programa')

@section('content')
	<x-header title="Programa"
		:$edition
		:$splash
		height="short" />

	<main>
		<section class="w-full px-6 max-w-7xl mx-auto -mt-12 md:px-16">
			<div class="w-full overflow-x-scroll md:overflow-hidden">
				<nav class="flex items-center gap-2 justify-start md:justify-center md:gap-4" role="tablist">
					@foreach ($schedules as $date => $items)
						<button type="button"
							id="tab-{{ Str::camel($date) }}"
							class="text-center rounded-sm transition-colors bg-(--vdl-bg-color) text-(--vdl-txt-color) border border-(--vdl-splash-txt-color)/50 p-3 aria-selected:bg-(--vdl-secondary-color) aria-selected:text-(--vdl-secondary-txt-color) aria-selected:border-(--vdl-secondary-color)"
							aria-selected="{{ $loop->first ? 'true' : 'false' }}"
							aria-controls="panel-{{ Str::camel($date) }}"
							role="tab"
							tabindex="{{ $loop->first ? '0' : '-1' }}">
							<span class="block uppercase text-xl leading-4">{{ printDDay($date) }}</span>
							<span class="block font-semibold text-5xl leading-none">{{ substr($date, 8, 2) }}</span>
							<span class="block uppercase font-bold text-xl leading-4">{{ printMMonth($date) }}</span>
						</button>
					@endforeach
				</nav>
			</div>

			@foreach ($schedules as $date => $items)
				<div id="panel-{{ Str::camel($date) }}"
					class="my-12"
					aria-labelledby="tab-{{ Str::camel($date) }}"
					role="tabpanel"
					tabindex="0"
					@if (!$loop->first) hidden @endif>

					@foreach ($items as $item)
						<div class="mb-6 not-first:border-t not-first:border-(--vdl-splash-txt-color)/25 not-first:pt-6 md:grid md:grid-cols-6 md:gap-2">

							<p class="text-xl font-semibold inline-block mr-2">
								{{ $item->start_time->format('H:i') }}
							</p>

							<p class="text-xl font-semibold inline-block md:col-span-3">
								{{ $item->description }}
							</p>

							<div class="text-lg mt-4 md:col-span-5 md:col-start-2 md:mt-0">

								@foreach ($item->films as $film)
									<p class="mt-2">
										<a href="{{ route('film', ['slug' => $film->slug]) }}">
											<span class="font-semibold">{{ $film->title }},</span> {{ $film->director }} ({{ $film->year }})
										</a>
									</p>
								@endforeach

								@foreach ($item->activities as $activity)
									<p class="mt-2">
										<a href="{{ route('activity', ['slug' => $activity->slug]) }}">
											<span class="font-semibold">{{ $activity->title }}</span>
										</a>
									</p>
								@endforeach

								@isset($item->notes)
									<p class="text-sm mt-2">{{ $item->notes }}</p>
								@endisset

								<p class="text-sm mt-4">
									<x-filament::icon icon="bx-map" class="w-5 h-5 inline-block align-text-bottom"/>
									<span class="font-semibold">{{ $item->venue->name }}</span>. {{ $item->venue->town }}
								</p>

							</div>
						</div>
					@endforeach
				</div>
			@endforeach

		</section>
	</main>
@endsection
