<footer class="w-full min-h-4 bg-(--vdl-splash-bg-color) text-(--vdl-splash-txt-color) text-sm">
	<div class="px-6 py-12 grid grid-cols-2 gap-6 items-center md:px-16 md:grid-cols-3 md:gap-12 lg:grid-cols-6 lg:items-start xl:px-20">
		@isset($edition)
			@isset($edition->footer)
				{!! str($edition->footer)->markdown()->sanitizeHtml() !!}
			@endisset
			@empty($edition->footer)
			<div class="space-y-4">
				<p>Promovido por</p>
				<img src="{{ asset('images/logos/memoria-e-naufraga.png') }}" alt="Logo a Memoria é naufraga">
			</div>
			<div class="space-y-4">
				<p>Financiado por</p>
				<img src="{{ asset('images/logos/deputacion-lugo.png') }}" alt="Logo Deputación de Lugo">
			</div>
			<div class="space-y-4">
				<img src="{{ asset('images/logos/camoes.png') }}" alt="Logo Instituto Camoes">
			</div>
			<div class="space-y-4">
				<img src="{{ asset('images/logos/sober-logo.svg') }}" alt="Sober">
			</div>
			<div class="space-y-4">
				<p>Colabora</p>
				<img src="{{ asset('images/logos/concello-de-boveda-logo.svg') }}" alt="Concello de Bóveda">
			</div>
			<div class="space-y-4">
				<p>Espazo</p>
				<img src="{{ asset('images/logos/a-casa-da-memoria.png') }}" alt="A Casa de Memoria">
			</div>
			@endempty
		@endisset
	</div>
</footer>
