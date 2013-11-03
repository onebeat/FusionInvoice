<?php namespace FI\Classes;

class Directory {
	
	public static function listContents($path)
	{
		return array_diff(scandir($path), array('.', '..'));
	}

}