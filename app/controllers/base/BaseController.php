<?php

class BaseController extends Controller {

	public function __construct()
	{
		$this->sites = config('site');
		$this->layout = template('layouts.base');
	}

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}
