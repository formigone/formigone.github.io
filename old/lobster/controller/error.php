<?php

class Error implements Controller
{
	private $MF;
	public $style;
	public $jLib;
	public $header;
	
	function __construct()
	{
		$this->MF = new MF();
		$this->style = $this->MF->getStyle('dashboard');
		$this->jLib = $this->MF->loadJs('dashboard');
		$this->header = $this->MF->getHeader('Music to my ears');
	}
	
	function execute()
	{
		include '/home/a2647781/public_html/lobster/view/404.php';
	}
}