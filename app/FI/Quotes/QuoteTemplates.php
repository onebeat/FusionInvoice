<?php namespace FI\Quotes;

class QuoteTemplates extends \FI\Classes\Templates {

	public static function lists()
	{
		return parent::listTemplates(app_path() . '/views/templates/quotes');
	}

}