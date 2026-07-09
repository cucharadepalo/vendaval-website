<header class="w-full relative overflow-hidden {{ $height == 'tall' ? 'portrait:aspect-square portrait:md:aspect-4/3 landscape:aspect-4/3 landscape:xl:aspect-2/1 landscape:xl:bg-position-[center_top_35%]' : 'portrait:aspect-3/2 landscape:aspect-5/1 landscape:lg:bg-center' }} bg-(--vdl-splash-bg-color) bg-cover bg-no-repeat text-(--vdl-splash-txt-color) pt-4" @isset($splash)style="background-image: url({{ $splash->getFullUrl() }})"@endisset>

	<div class="w-[3/4] max-w-75 text-center lg:ml-8 xl:max-w-80">
		<a href="{{ route('home') }}"><img src="{{ Vite::asset('resources/images/lgo-vndvl-26-hrz-lirio.webp') }}" class="w-full h-auto" alt="Vendaval"></a>
		@isset($thirdLine)
		<p class="text-(--vdl-secondary-color) font-brand text-xl relative -top-6">{{ $thirdLine }}</p>
		@endisset
	</div>
	<div class="absolute {{ $height == 'tall' ? 'bottom-4 left-0 right-0 px-8 text-3xl md:text-4xl lg:bottom-6 lg:px-32 lg:text-5xl' : 'top-24 left-18 text-4xl md:top-auto md:bottom-4 md:left-0 md:right-0 md:px-16 md:text-5xl' }}">
		<h1 class="font-brand text-center text-balance">{{ $title }}</h1>
	</div>

	<button type="button" class="toggle-menu w-10 h-10 absolute top-4 right-4 text-(--vdl-splash-txt-color) bg-(--vdl-secondary-color) flex items-center justify-center z-20">
		<span class="state-close">
			<x-filament::icon icon="bx-menu" class="w-8 h-8 block" />
		</span>
		<span class="state-open hidden">
			<span class="text-4xl leading-6">&times;</span>
			<span class="sr-only">Pechar</span>
		</span>
	</button>
</header>

<nav class="site-menu absolute w-full h-screen -top-full right-0 bottom-0 left-0 bg-(--vdl-splash-bg-color) text-(--vdl-splash-txt-color) flex items-center justify-center z-10">

	<ul class="text-4xl font-brand text-center space-y-2 2xl:text-5xl 2xl:space-y-6">
		@foreach ($pages as $page)
		<li><a href="{{ $page->getLink() }}" class="hover:text-(--vdl-secondary-color)">{{ $page->title }}</a></li>
		@endforeach
	</ul>

	<ul class="absolute bottom-4 text-center flex justify-center gap-1 items-center 2xl:gap-2 2xl:bottom-8">
		<li>
			<a href="https://www.instagram.com/vendaval_mostracinemapt/" target="_blank" title="Instagram"><x-filament::icon icon="bxl-instagram" class="w-8 h-8 inline-block 2xl:w-12 2xl:h-12" /></a>
		</li>
		<li>
			<a href="https://www.facebook.com/vendavalmostracinemapt" target="_blank" title="Facebook"><x-filament::icon icon="bxl-facebook" class="w-8 h-8 inline-block 2xl:w-12 2xl:h-12" /></a>
		</li>
		<li>
			<a href="https://www.youtube.com/@Vendaval_mostracinemaportugues" target="_blank" title="Youtube"><x-filament::icon icon="bxl-youtube" class="w-8 h-8 inline-block 2xl:w-12 2xl:h-12" /></a>
		</li>
	</ul>
</nav>
