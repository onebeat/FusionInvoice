<?php namespace FI\Classes;

class Templates {

	/**
	 * Returns an array of invoice templates
	 * @return array
	 */
	public static function listInvoiceTemplates()
	{
		$templates = Directory::listContents(app_path() . '/views/templates/invoices');

		return array_combine($templates, $templates);
	}

	/**
	 * Returns an array of quote templates
	 * @return array
	 */
	public static function listQuoteTemplates()
	{
		$templates = Directory::listContents(app_path() . '/views/templates/quotes');

		return array_combine($templates, $templates);
	}
}