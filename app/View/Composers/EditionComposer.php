<?php

namespace App\View\Composers;

use App\Models\Edition;
use App\Models\Page;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;

class EditionComposer
{
	/**
	 * Create a new edition composer.
	 */
	public function __construct(
		protected null | Edition $edition,
		protected null | Collection $pages,
	) {
		$this->edition = Edition::where('is_active', 1)->first();
		$this->pages = Page::whereIsPublished(1)->whereInMenu(1)->get();
	}

	/**
	 * Bind data to the view.
	 */
	public function compose(View $view): void
	{
		$splash = $this->edition ? $this->edition->getMedia('splash')->first() : null;

		$view->with(['edition' => $this->edition, 'splash' => $splash, 'pages' => $this->pages ]);
	}
}
