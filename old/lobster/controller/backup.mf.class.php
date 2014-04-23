<?php

class MF
{
	private $BR;
	private $TB;
	
	function __construct()
	{
		$this->BR = "\n";
		$this->TB = "\t";
	}
	
	function getStyle( $pView )
	{
		return $this->TB . '<link rel="stylesheet" type="text/css" href="resources/style/' . $pView . '.css" />' . $this->BR;
	}
	
	function getFavicon()
	{
		return $this->TB . '<link rel="shortcut icon" href="favicon.ico" />'  . $this->BR;
	}
	
	function getJq()
	{
		return $this->TB . '<script type="text/javascript" src="resources/js/jq.js"></script>'  . $this->BR;
	}
	
	function loadJs( $pLib )
	{
		return $this->TB . '<script type="text/javascript" src="resources/js/' . $pLib . '.js"></script>' . $this->BR;
	}
	
	function getHeader( $pTitle )
	{
		return '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"' . $this->BR .
				'"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">' . $this->BR .
				'<html xmlns="http://www.w3.org/1999/xhtml">' . $this->BR .
				'<head>' . $this->BR .
				'<title>' . $pTitle . '</title>';
	}
}