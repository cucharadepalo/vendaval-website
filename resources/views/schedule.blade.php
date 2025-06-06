@extends('layouts.app')

@section('title', $page->title)

@section('content')
	<x-header title="{{ $page->title }}"
		:$edition
		:$splash
		height="short" />

	<main class="pb-24">
		<section id="programa" class="relative px-6 mt-6 md:px-16 xl:px-20 xl:mt-12">
			<div class="w-full overflow-x-scroll md:overflow-hidden">
				<nav class="flex items-center gap-2 justify-start md:gap-4 lg:justify-center" role="tablist">
					@foreach ($schedules as $date => $items)
						<button type="button"
							id="tab-{{ Str::camel($date) }}"
							class="text-center rounded-sm transition-colors bg-(--vdl-bg-color) text-(--vdl-txt-color) p-3 border border-(--vdl-splash-txt-color)/30 aria-selected:bg-(--vdl-secondary-color) aria-selected:text-(--vdl-secondary-txt-color) aria-selected:border-(--vdl-secondary-color) focus:outline-0 xl:p-4"
							aria-selected="false"
							aria-controls="panel-{{ Str::camel($date) }}"
							role="tab"
							datetime="{{ $date }}"
							tabindex="-1">
							<span class="block uppercase text-xl leading-4 xl:text-2xl xl:leading-5">{{ printDDay($date) }}</span>
							<span class="block font-semibold text-5xl leading-none xl:text-6xl">{{ substr($date, 8, 2) }}</span>
							<span class="block uppercase font-bold text-xl leading-4 xl:text-2xl xl:leading-5">{{ printMMonth($date) }}</span>
						</button>
					@endforeach
				</nav>
			</div>

			@foreach ($schedules as $date => $items)
				<div id="panel-{{ Str::camel($date) }}"
					class="my-6 max-w-4xl mx-auto xl:my-12"
					aria-labelledby="tab-{{ Str::camel($date) }}"
					role="tabpanel"
					tabindex="0"
					@if (!$loop->first) hidden @endif>

					@foreach ($items as $item)
						<div class="not-first:mt-12 border-t border-(--vdl-splash-txt-color)/30 pt-4 lg:grid lg:grid-cols-4 lg:gap-6 lg:items-center xl:pt-8 xl:gap-8 xl:not-first:mt-16">

							<p class="text-xl font-semibold inline-block mr-2 lg:mr-0 lg:text-right lg:text-2xl xl:text-3xl">
								{{ $item->start_time->format('H:i') }}
							</p>

							<p class="text-xl inline-block lg:col-span-3 lg:text-2xl xl:text-3xl">
								{{ $item->description }}
							</p>

							@foreach ($item->films as $film)
								<div class="hidden lg:block">
									{{ $film->getFirstMedia('stills') ? $film->getFirstMedia('stills')('still_opt')->attributes(['class' => 'w-full aspect-video object-center rounded-sm', 'width' => '160', 'height' => '90'])->lazy() : '' }}
								</div>
								<div class="text-lg text-pretty mt-4 lg:mt-0 lg:col-span-3 lg:text-xl">
									<a href="{{ route('film', ['slug' => $film->slug]) }}">
										<span class="block font-semibold lg:text-2xl xl:text-3xl">{{ $film->title }}</span>
										{{ $film->director }} <span class="lg:block">({{ $film->year }})</span>
									</a>
								</div>
							@endforeach

							@foreach ($item->activities as $activity)
								<div class="hidden lg:block">
									{{ $activity->getFirstMedia('image') ? $activity->getFirstMedia('image')('image_opt')->attributes(['class' => 'w-full aspect-video object-center object-cover rounded-sm', 'width' => '160', 'height' => '90'])->lazy() : '' }}
								</div>
								<div class="text-lg text-pretty mt-4 lg:mt-0 lg:col-span-3 lg:text-xl">
									<a href="{{ route('activity', ['slug' => $activity->slug]) }}">
										<span class="block font-semibold lg:text-2xl xl:text-3xl">{{ $activity->title }}</span>
										{{ $activity->summary }}
									</a>
								</div>
							@endforeach

							@isset($item->notes)
								<p class="text-sm text-pretty mt-4 lg:mt-0 lg:col-span-3 lg:col-start-2 lg:text-lg">{{ $item->notes }}</p>
							@endisset

							<div class="text-sm mt-4 lg:mt-0 lg:col-span-3 lg:col-start-2 lg:text-lg">
								<a href="{{ route('where') }}">
									<x-filament::icon icon="bx-map" class="w-5 h-5 inline-block align-text-bottom lg:w-6 lg:h-6"/>
									<span class="font-semibold">{{ $item->venue->name }}</span>
								</a>
							</div>
						</div>
					@endforeach
				</div>
			@endforeach

		</section>

		@if ($page->content)
			<section id="contido" class="my-12 px-6 md:px-16 xl:px-20 xl:my-24">
				<x-content-wrapper :content="$page->content" />
			</section>
		@endif
	</main>
@endsection
