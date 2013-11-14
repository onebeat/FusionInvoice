<?php namespace FI\Templates;

class InvoiceTemplates extends Templates {

	public static function lists()
	{
		return parent::listTemplates(app_path() . '/views/templates/invoices');
	}

}