<?php namespace FI\Classes;

class Templates {

	static function listInvoicePdfTemplates()
	{
		$templates = Directory::listContents(app_path() . '/views/templates/invoices/pdf');

		return array_combine($templates, $templates);
	}

	static function listInvoicePublicTemplates()
	{
		$templates = Directory::listContents(app_path() . '/views/templates/invoices/public');

		return array_combine($templates, $templates);
	}

	static function listQuotePdfTemplates()
	{
		$templates = Directory::listContents(app_path() . '/views/templates/quotes/pdf');

		return array_combine($templates, $templates);
	}

	static function listQuotePublicTemplates()
	{
		$templates = Directory::listContents(app_path() . '/views/templates/invoices/public');

		return array_combine($templates, $templates);
	}

}