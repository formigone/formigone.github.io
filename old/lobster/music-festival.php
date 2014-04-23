<?php

require_once '/home/a2647781/public_html/lobster/controller/controller.interface.php';

class MusicFestival
{
	public $controller;
	public $URL;
	
	function __construct()
	{
		$this->controller = isset( $_GET['controller']) ? $_GET['controller'] : 'home';
		$this->URL = '/home/a2647781/public_html/lobster/';
	}
	
	function load()
	{
		if( file_exists( $this->URL.'controller/' . $this->controller . '.php') )
		{
			require $this->URL.'controller/' . $this->controller . '.php';

			$class = ucfirst( $this->controller );
			$obj = new $class();
			$obj->execute();			
		}
		else
		{
			require $this->URL.'controller/error.php';
			$error = new Error();
			$error->execute();
		}
	}
}

$MF = new MusicFestival();