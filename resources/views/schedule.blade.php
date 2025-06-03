@extends('layouts.app')

@section('title', $page->title)

@section('content')
	<x-header title="{{ $page->title }}"
		:$edition
		:$splash
		height="short" />

	<main>
		<section class="px-6 -mt-12 md:px-16 xl:px-20">
			<div class="w-full overflow-x-scroll md:overflow-hidden">
				<nav class="flex items-center gap-2 justify-start md:gap-4" role="tablist">
					@foreach ($schedules as $date => $items)
						<button type="button"
							id="tab-{{ Str::camel($date) }}"
							class="text-center rounded-sm transition-colors bg-(--vdl-bg-color) text-(--vdl-txt-color) p-3 aria-selected:bg-(--vdl-secondary-color) aria-selected:text-(--vdl-secondary-txt-color)"
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
						<div class="not-first:mt-12 md:grid md:grid-cols-6 md:gap-2 xl:not-first:mt-24 xl:gap-8">

							<p class="text-xl font-semibold inline-block mr-2 xl:text-2xl">
								{{ $item->start_time->format('H:i') }}
							</p>

							<p class="text-xl font-semibold inline-block md:col-span-3 xl:text-2xl">
								{{ $item->description }}
							</p>

							<div class="text-lg mt-4 md:col-span-5 md:col-start-2 md:mt-0 xl:text-2xl">

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

								<div class="text-sm mt-6">
									<a href="{{ route('where') }}">
										<x-filament::icon icon="bx-map" class="w-5 h-5 inline-block align-text-bottom"/>
										<span class="font-semibold">{{ $item->venue->name }}</span>. {{ $item->venue->town }}
									</a>
								</div>

							</div>
						</div>
					@endforeach
				</div>
			@endforeach

		</section>

		@if ($page->content)
			<section class="w-full px-6 max-w-7xl mx-auto md:px-16 my-12">
				<div class="md-wrapper md:columns-2 md:gap-12 xl:columns-3 space-y-6">
					{!! str($page->content)->markdown()->sanitizeHtml() !!}
				</div>
			</section>
		@endif
	</main>
@endsection
