<?php

class CORSFilter
{
	protected $clients = array();

	public function checkOrigin($route, $request){

		if($this->isValidOrigin( $_SERVER['HTTP_ORIGIN']))
			header('Access-Control-Allow-Origin: *');
	}

	public function isValidOrigin($host){

		return in_array($host, $this->clients);
	}
}