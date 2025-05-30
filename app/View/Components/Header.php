<?php

namespace App\View\Components;

use Closure;
use App\Models\Edition;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Header extends Component
{
	/**
	 * Create a new component instance.
	 */
	public function __construct(
		public null | Edition $edition,
		public null | Media $splash,
		public ?string $height,
		public ?string $title,
		public ?string $thirdLine,
	) {}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.header');
	}
}
