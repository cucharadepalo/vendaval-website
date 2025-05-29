<?php

namespace App\View\Composers;

use App\Models\Edition;
use Illuminate\View\View;

class EditionComposer
{
	/**
	 * Create a new edition composer.
	 */
	public function __construct(
		protected null | Edition $edition,
	) {
		$this->edition = Edition::where('is_active', 1)->first();
	}

	/**
	 * Bind data to the view.
	 */
	public function compose(View $view): void
	{
		$splash_portrait = $this->edition->getMedia('splash', ['version' => 'portrait'])->first();
		$splash_landscape = $this->edition->getMedia('splash', ['version' => 'landscape'])->first();

		$view->with(['edition' => $this->edition, 'splash_landscape' => $splash_landscape, 'splash_portrait' => $splash_portrait ]);
	}
}
