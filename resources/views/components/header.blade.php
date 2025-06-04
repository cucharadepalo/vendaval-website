<header class="w-full relative overflow-hidden {{ $height == 'tall' ? 'portrait:aspect-p-tall landscape:aspect-l-tall pt-16' : 'portrait:aspect-p-short landscape:aspect-l-short pt-6' }} bg-(--vdl-splash-bg-color) bg-cover bg-center bg-no-repeat text-(--vdl-splash-txt-color) "@isset($splash)style="background-image: url({{ $splash->getFullUrl() }})"@endisset>

	<div class="px-6 md:px-16 xl:px-20">

		<div>
			<h1><a href="{{ route('home') }}" class="splash-title {{ $height == 'tall' ? 'mega' : 'simple' }}">Vendaval</a> <span class="splash-subtitle {{ $height == 'tall' ? 'simple' : 'mega' }}">{{ $title }}</span> @isset($thirdLine)<span class="splash-subtitle simple">{{ $thirdLine }}</span>@endisset</h1>
		</div>

		<nav class="site-menu absolute w-full h-full -top-full right-0 bottom-0 left-0 bg-(--vdl-splash-bg-color)/80 text-(--vdl-splash-txt-color) flex items-center justify-center backdrop-blur-lg">

			<ul class="text-3xl space-y-2 text-center">
				@foreach ($pages as $page)
				<li><a href="{{ $page->getLink() }}">{{ $page->title }}</a></li>
				@endforeach
			</ul>

			<ul class="absolute bottom-2 w-full flex gap-2 items-center justify-center">
				<li>
					<a href="https://www.instagram.com/vendaval_mostracinemapt/" target="_blank" title="Instagram">
						<x-filament::icon icon="bxl-instagram" class="w-8 h-8 inline-block"/>
					</a>
				</li>
				<li>
					<a href="https://www.facebook.com/vendavalmostracinemapt" target="_blank" title="Facebook">
						<x-filament::icon icon="bxl-facebook-circle" class="w-8 h-8 inline-block"/>
					</a>
				</li>
			</ul>
		</nav>

		<button type="button" class="toggle-menu w-10 h-10 absolute top-6 right-6 bg-(--vdl-splash-bg-color) text-(--vdl-splash-txt-color) flex items-center justify-center">
			<span class="state-close">
				<x-filament::icon icon="bx-menu" class="w-8 h-8 block" />
			</span>
			<span class="state-open hidden">
				<span class="text-4xl leading-6">&times;</span>
				<span class="sr-only">Pechar</span>
			</span>
		</button>
	</div>
</header>
