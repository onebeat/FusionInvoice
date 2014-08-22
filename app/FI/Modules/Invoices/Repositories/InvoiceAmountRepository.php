<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Invoices\Repositories;

use FI\Classes\CurrencyFormatter;
use FI\Modules\Invoices\Models\InvoiceAmount;

class InvoiceAmountRepository {
	
	/**
	 * Get a single record
	 * @param  int $id
	 * @return InvoiceAmount
	 */
	public function find($id)
	{
		return InvoiceAmount::find($id);
	}

	/**
	 * Get a list of records by invoice id
	 * @param  int $invoiceId
	 * @return InvoiceAmount
	 */
	public function findByInvoiceId($invoiceId)
	{
		return InvoiceAmount::where('invoice_id', '=', $invoiceId)->first();
	}

	/**
	 * Create a record
	 * @param  array $input
	 * @return int
	 */
	public function create($input)
	{
		return InvoiceAmount::create($input)->id;
	}

	/**
	 * Update a record
	 * @param  array $input
	 * @param  int $invoiceId
	 * @return void
	 */
	public function update($input, $invoiceId)
	{
		$invoiceAmount = InvoiceAmount::where('invoice_id', $invoiceId)->first();

		$invoiceAmount->fill($input);

		$invoiceAmount->save();
	}

	/**
	 * Delete a record
	 * @param  int $id
	 * @return void
	 */
	public function delete($id)
	{
		InvoiceAmount::destroy($id);
	}

	/**
	 * Get a grouped list of amounts by status
	 * @param  array $statuses
	 * @return array
	 */
	public function getTotalsByStatus($statuses)
	{
		$amounts = array();

		foreach ($statuses as $key => $status)
		{
			$amounts[$key] = CurrencyFormatter::format(0);
		}

		$invoiceAmounts = InvoiceAmount::select('invoices.invoice_status_id', \DB::raw('SUM(invoice_amounts.total) AS total'))
		->join('invoices', 'invoices.id', '=', 'invoice_amounts.invoice_id')
		->groupBy('invoices.invoice_status_id')
		->get();

		foreach ($invoiceAmounts as $invoiceAmount)
		{
			$amounts[$invoiceAmount->invoice_status_id] = CurrencyFormatter::format($invoiceAmount->total);
		}

		return $amounts;
	}

}