<div {{ $attributes->merge(['class' => 'md-wrapper' . ($hasCols() & !$noCols ? ' lg:columns-2 lg:gap-12' : ' max-w-2xl mx-auto')]) }}>
  {!! str($content)->markdown()->sanitizeHtml() !!}
</div>

<!-- {{ $words }} -->
