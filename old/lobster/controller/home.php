<?php

class Home implements Controller
{
	private $MF;
	public $style;
	public $jLib;
	public $errLog;
	public $header;
	
	function __construct()
	{
		$this->MF = new MF();
		$this->style = $this->MF->getStyle('home');
		$this->jLib = $this->MF->loadJs('home');
		$this->header = $this->MF->getHeader('Music to my ears');
		$this->errLog = $this->MF->getErrorPanel();
	}
	
	function execute()
	{
		include '/home/a2647781/public_html/lobster/view/home.php';
	}
}