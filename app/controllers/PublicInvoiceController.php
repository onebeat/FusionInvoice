<?php

class PublicInvoiceController extends BaseController {

	protected $invoice;

	public function __construct($invoice)
	{
		$this->invoice = $invoice;
	}
	
	/**
	 * Displays the invoice based on the invoice key
	 * @param  string $urlKey
	 * @return View
	 */
	public function show($urlKey)
	{
		$invoice = $this->invoice->findByUrlKey($urlKey);

		return View::make('templates.invoices.' . str_replace('.blade.php', '', Config::get('fi.invoiceTemplate')))
		->with('invoice', $invoice);
	}

}