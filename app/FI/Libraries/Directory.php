<?php namespace FI\Libraries;

class Directory {
	
	public static function listContents($path)
	{
		return array_diff(scandir($path), array('.', '..'));
	}

}