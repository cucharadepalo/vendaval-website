<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;
use JSW\Figure\FigureExtension;
use League\CommonMark\Extension\DisallowedRawHtml\DisallowedRawHtmlExtension;

class ContentWrapper extends Component
{
	/**
	 * Create a new component instance.
	 */
	public function __construct(
		public string $content,
		public ?int $words,
		public ?bool $noCols,
	) {}

	/**
	 * Determine if the content is long enough to use cols.
	 */
	public function hasCols(): bool
	{
		return $this->words > 200;
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		$html = str($this->content)->markdown()->sanitizeHtml();
		$strip = strip_tags($html);
		$this->words = Str::of($strip)->wordCount();
		$words = strval($this->words);
		$html_string = Str::markdown($this->content, [
			'html_input' => 'allow',
			'allow_unsafe_links' => false,
			'disallowed_raw_html' => [
        'disallowed_tags' => ['title', 'textarea', 'style', 'xmp', 'noembed', 'noframes', 'script', 'plaintext'],
    	],
		], [
			new DisallowedRawHtmlExtension(), new FigureExtension()
		]);

		return view('components.content-wrapper', compact('words', 'html_string'));
	}
}
