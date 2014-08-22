<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Invoices\Controllers;

use Config;
use View;

class PublicInvoiceController extends \BaseController {

	/**
	 * Invoice repository
	 * @var InvoiceRepository
	 */
	protected $invoice;

	/**
	 * Dependency injection
	 * @param InvoiceRepository $invoice
	 */
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