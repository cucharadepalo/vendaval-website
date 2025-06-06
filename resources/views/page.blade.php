@extends('layouts.app')

@section('title', $page->title)

@section('content')
	<x-header title="{{ $page->title }}"
		:$edition
		:$splash
		height="short" />

	<main>
		<section class="text-lg text-gray-950 text-pretty my-16 xl:my-24">
			<div class="w-full px-6 max-w-7xl mx-auto">
				@if ($page->content)
					<x-content-wrapper :content="$page->content" />
				@endif
			</div>
		</section>
	</main>
@endsection
