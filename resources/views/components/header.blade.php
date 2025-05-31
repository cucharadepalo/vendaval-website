<header class="w-full {{ $height == 'tall' ? 'aspect-[5/4] pt-16' : 'aspect-[5/3] pt-6' }} bg-(--vdl-splash-bg-color) bg-cover bg-center bg-no-repeat text-(--vdl-splash-txt-color) "@isset($splash)style="background-image: url({{ $splash->getFullUrl() }})"@endisset>

	<div class="w-full px-6 max-w-7xl mx-auto xl:grid xl:grid-cols-3 xl:gap-12">

		<div class="col-span-2">
			<h1><a href="{{ route('home') }}" class="splash-title {{ $height == 'tall' ? 'mega' : 'simple' }}">Vendaval</a> <span class="splash-subtitle {{ $height == 'tall' ? 'simple' : 'mega' }}">{{ $title }}</span> @isset($thirdLine)<span class="splash-subtitle simple">{{ $thirdLine }}</span>@endisset</h1>
		</div>

		{{-- <nav class="pt-24 xl:h-full xl:flex xl:items-end xl:justify-start">
			<ul class="text-xl font-medium xl:text-3xl">
				<li><a href="#">Programa</a></li>
				<li><a href="#">Filmes</a></li>
				<li><a href="#">A Casa da memoria</a></li>
				<li><a href="#">Mais</a></li>
			</ul>
		</nav> --}}

	</div>
</header>
