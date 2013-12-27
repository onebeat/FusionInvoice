<?php

use FI\Statuses\QuoteStatuses;
use FI\Statuses\InvoiceStatuses;

class DashboardController extends BaseController {
	
	protected $invoice;
	protected $quote;
	protected $invoiceAmount;
	protected $quoteAmount;

	public function __construct($invoice, $quote, $invoiceAmount, $quoteAmount)
	{
		$this->invoice       = $invoice;
		$this->quote         = $quote;
		$this->invoiceAmount = $invoiceAmount;
		$this->quoteAmount   = $quoteAmount;
	}

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