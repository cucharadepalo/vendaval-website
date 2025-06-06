<div {{ $attributes->merge(['class' => 'md-wrapper' . ($hasCols() ? ' lg:columns-2 lg:gap-12 xl:columns-3' : ' max-w-xl')]) }}>
  {!! $content !!}
</div>
