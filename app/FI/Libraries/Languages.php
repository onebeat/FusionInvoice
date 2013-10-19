<?php namespace FI\Libraries;

class Languages {
	
	static function listLanguages()
	{
		$directories = Directory::listContents(app_path() . '/lang');

		$languages = array();

		foreach ($directories as $directory)
		{
			$languages[$directory] = $directory;
		}

		return $languages;
	}

}