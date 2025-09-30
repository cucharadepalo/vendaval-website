<footer class="w-full min-h-4 bg-(--vdl-splash-bg-color) text-(--vdl-splash-txt-color) text-sm">
	<div class="px-6 py-12 flex flex-wrap items-start gap-6 md:px-16 xl:px-20">
		@isset($edition)
			@isset($edition->footer)
				{!! str($edition->footer)->markdown()->sanitizeHtml() !!}
			@endisset
			@empty($edition->footer)
			<div class="space-y-2">
				<p class="text-orange-300">Promovido por</p>
				<div class="flex items-end justify-start gap-6">
					<img src="{{ asset('images/logos/memoria-e-naufraga.png') }}" alt="Logo a Memoria é naufraga" loading="lazy" width="120" height="76">
					<img src="{{ asset('images/logos/duplacena.png') }}" alt="Duplacena" loading="lazy" width="180" height="23">
				</div>
			</div>
			<div class="space-y-2">
				<p class="text-orange-300">Financiado por</p>
				<div class="flex flex-wrap items-center justify-start gap-6">
					<img src="{{ asset('images/logos/deputacion-lugo.png') }}" alt="Logo Deputación de Lugo" loading="lazy" width="167" height="45">
					<img src="{{ asset('images/logos/ICA.png') }}" alt="Instituto do cinema e do audiovisual" loading="lazy" width="180" height="41">
					<img src="{{ asset('images/logos/republica-portuguesa.png') }}" alt="República Portuguesa. Cultura Juventude e desporto" loading="lazy" width="123" height="64">
					<img src="{{ asset('images/logos/camoes.png') }}" alt="Logo Instituto Camoes" loading="lazy" width="120" height="60">
					<img src="{{ asset('images/logos/sober-logo.svg') }}" alt="Sober" loading="lazy" width="84" height="36">
				</div>
			</div>
			<div class="space-y-2">
				<p class="text-orange-300">Colabora</p>
				<img src="{{ asset('images/logos/concello-de-boveda-logo.svg') }}" alt="Concello de Bóveda" loading="lazy" width="103" height="50">
			</div>
			<div class="space-y-2">
				<p class="text-orange-300">Espazo</p>
				<img src="{{ asset('images/logos/a-casa-da-memoria.png') }}" alt="A Casa de Memoria" loading="lazy" width="100" height="76">
			</div>
			@endempty
		@endisset
	</div>
</footer>
