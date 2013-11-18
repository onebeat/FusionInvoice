<?php namespace FI\Templates;

abstract class Templates {

	/**
	 * Returns an array of templates
	 * @return array
	 */
	public static function listTemplates($path)
	{
		$templates = \FI\Classes\Directory::listContents($path);

		return array_combine($templates, $templates);
	}
}