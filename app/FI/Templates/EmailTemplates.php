<?php namespace FI\Templates;

class EmailTemplates extends Templates {
	
	public static function lists()
	{
		return parent::listTemplates(app_path() . '/views/templates/emails');
	}

}