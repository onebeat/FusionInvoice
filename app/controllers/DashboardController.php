<?php

use FI\Quotes\QuoteStatuses;
use FI\Invoices\InvoiceStatuses;
use FI\Storage\Interfaces\QuoteRepositoryInterface;
use FI\Storage\Interfaces\InvoiceRepositoryInterface;

class DashboardController extends BaseController {
	
	protected $invoice;
	protected $quote;

	public function __construct(InvoiceRepositoryInterface $invoice, QuoteRepositoryInterface $quote)
	{
		$this->invoice = $invoice;
		$this->quote = $quote;
	}

	public function index()
	{
		return View::make('dashboard.index')
		->with('quoteStatuses', QuoteStatuses::statuses())
		->with('invoiceStatuses', InvoiceStatuses::statuses())
		->with('overdueInvoices', $this->invoice->getRecentOverdue(15))
		->with('recentInvoices', $this->invoice->getRecent(15))
		->with('recentQuotes', $this->quote->getRecent(15));
	}

}