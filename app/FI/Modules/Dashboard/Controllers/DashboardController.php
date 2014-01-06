<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Dashboard\Controllers;

use View;

use FI\Statuses\QuoteStatuses;
use FI\Statuses\InvoiceStatuses;

class DashboardController extends \BaseController {
	
	/**
	 * Invoice repository
	 * @var InvoiceRepository
	 */
	protected $invoice;

	/**
	 * Quote repository
	 * @var QuoteRepository
	 */
	protected $quote;

	/**
	 * Invoice amount repository
	 * @var InvoiceAmountRepository
	 */
	protected $invoiceAmount;

	/**
	 * Quote amount repository
	 * @var QuoteAmountRepository
	 */
	protected $quoteAmount;

	/**
	 * Dependency injection
	 * @param InvoiceRepository $invoice
	 * @param QuoteRepository $quote
	 * @param InvoiceAmountRepository $invoiceAmount
	 * @param QuoteAmountRepository $quoteAmount
	 */
	public function __construct($invoice, $quote, $invoiceAmount, $quoteAmount)
	{
		$this->invoice       = $invoice;
		$this->quote         = $quote;
		$this->invoiceAmount = $invoiceAmount;
		$this->quoteAmount   = $quoteAmount;
	}

	/**
	 * Display the dashboard
	 * @return View
	 */
	public function index()
	{
		$invoiceStatuses = InvoiceStatuses::statuses();
		$quoteStatuses   = QuoteStatuses::statuses();

		unset($invoiceStatuses[0], $quoteStatuses[0]);

		return View::make('dashboard.index')
		->with('quoteStatuses', $quoteStatuses)
		->with('invoiceStatuses', $invoiceStatuses)
		->with('overdueInvoices', $this->invoice->getRecentOverdue(15))
		->with('recentInvoices', $this->invoice->getRecent(15))
		->with('recentQuotes', $this->quote->getRecent(15))
		->with('invoiceStatusAmounts', $this->invoiceAmount->getTotalsByStatus($invoiceStatuses))
		->with('quoteStatusAmounts', $this->quoteAmount->getTotalsByStatus($quoteStatuses));
	}

}