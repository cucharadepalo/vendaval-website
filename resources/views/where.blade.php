@extends('layouts.app')

@section('title', $page->title)

@section('content')
	<x-header title="{{ $page->title }}"
		:$edition
		:$splash
		height="short" />

	<main>
		<section class="w-full px-6 max-w-7xl mx-auto md:px-16">
			@if ($page->content)
				<div class="md-wrapper md:columns-2 md:gap-12 xl:columns-3 space-y-6">
					{!! str($page->content)->markdown()->sanitizeHtml() !!}
				</div>
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
							<div class="md-wrapper my-6">
								{!! str($venue->text)->markdown()->sanitizeHtml() !!}
							</div>
						@endif
					</div>
				@endforeach
			</div>
		</section>
		<nav class="w-full py-12 bg-(--vdl-secondary-color) text-(--vdl-secondary-txt-color)">
			<div class="px-6 max-w-7xl mx-auto flex flex-col">
				<a href="{{ route('filmes') }}" class="text-lg inline-block">&larr; Filmes</a>
				<a href="{{ route('schedule') }}" class="text-lg inline-block">&larr; Programa</a>
			</div>
		</nav>
	</main>
@endsection
