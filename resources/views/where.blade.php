@extends('layouts.app')

@section('title', $page->title)

@section('content')
	<x-header title="{{ $page->title }}"
		:$edition
		:$splash
		height="short" />

	<main>
		<section class="my-12 px-6 md:px-16 lg:px-8 xl:px-20 xl:my-16">
			@if ($page->content)
				<x-content-wrapper :content="$page->content" class="lg:text-lg xl:text-xl"/>
			@endif
			<div class="text-pretty my-12">
				@foreach ($venues as $venue)
					<div class="mt-12">
						<h2 class="text-xl font-semibold">{{ $venue->name }}</h2>
						<p class="text-lg">{{ $venue->town }}</p>
						<ul class="text-sm mt-2 space-y-1">
							@if ($venue->address)
								<li>
									<x-filament::icon icon="bx-map-alt" class="w-4 h-4 inline-block mr-1 align-text-bottom"/>
									{{ $venue->address }}
								</li>
							@endif
							@if ($venue->map)
								<li>
									<a href="{{ $venue->map }}" target="_blank">
										<x-filament::icon icon="bx-map" class="w-4 h-4 inline-block mr-1 align-text-bottom"/>
										Mapa
									</a>
								</li>
							@endif
							@if ($venue->website)
								<li>
									<a href="{{ $venue->website }}" target="_blank">
										<x-filament::icon icon="bx-link-alt" class="w-4 h-4 inline-block mr-1 align-text-bottom"/>
										{{ preg_replace(["(^https?://)", "(^http?://)"], '', $venue->website) }}
									</a>
								</li>
							@endif
						</ul>
						@if ($venue->text)
							<x-content-wrapper :content="$venue->text" class="lg:text-lg xl:text-xl" />
						@endif
					</div>
				@endforeach
			</div>
		</section>
		<nav class="w-full py-12 bg-(--vdl-secondary-color) text-(--vdl-secondary-txt-color)">
			<div class="px-6 md:px-16 lg:px-8 xl:px-20 flex flex-col">
				<a href="{{ route('filmes') }}" class="text-lg inline-block">&larr; Filmes</a>
				<a href="{{ route('schedule') }}" class="text-lg inline-block">&larr; Programa</a>
			</div>
		</nav>
	</main>
@endsection
