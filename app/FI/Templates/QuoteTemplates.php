<?php namespace FI\Templates;

class QuoteTemplates extends Templates {

	public static function lists()
	{
		return parent::listTemplates(app_path() . '/views/templates/quotes');
	}

}