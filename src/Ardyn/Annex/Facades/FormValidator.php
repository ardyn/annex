<?php

namespace Ardyn\Annex\Facades;

use Illuminate\Support\Facades\Facade;

class FormValidator extends Facade {

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor() { return 'form.validator'; }

}
