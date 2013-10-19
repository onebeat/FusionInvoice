<?php namespace FI\Libraries;

class Templates {

	static function listInvoicePdfTemplates()
	{
		return Directory::listContents(app_path() . '/views/templates/invoices/pdf');
	}

	static function listInvoicePublicTemplates()
	{
		return Directory::listContents(app_path() . '/views/templates/invoices/public');
	}

	static function listQuotePdfTemplates()
	{
		return Directory::listContents(app_path() . '/views/templates/quotes/pdf');
	}

	static function listQuotePublicTemplates()
	{
		return Directory::listContents(app_path() . '/views/templates/invoices/public');
	}

}