<?php namespace FI\Invoices;

class InvoiceTemplates extends \FI\Classes\Templates {

	public static function lists()
	{
		return parent::listTemplates(app_path() . '/views/templates/invoices');
	}

}