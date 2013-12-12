<?php namespace FI\Storage\Eloquent\Repositories;

use FI\Classes\CurrencyFormatter;
use FI\Storage\Eloquent\Models\InvoiceAmount;

class InvoiceAmountRepository implements \FI\Storage\Interfaces\InvoiceAmountRepositoryInterface {
	
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
	 * Create a record
	 * @param  int $invoiceId
	 * @param  float $itemSubtotal
	 * @param  float $itemTaxTotal
	 * @param  float $taxTotal
	 * @param  float $total
	 * @param  float $paid
	 * @param  float $balance
	 * @return void
	 */
	public function create($invoiceId, $itemSubtotal, $itemTaxTotal, $taxTotal, $total, $paid, $balance)
	{
		InvoiceAmount::create(
			array(
				'invoice_id'     => $invoiceId,
				'item_subtotal'  => $itemSubtotal,
				'item_tax_total' => $itemTaxTotal,
				'tax_total'      => $taxTotal,
				'total'          => $total,
				'paid'           => $paid,
				'balance'        => $balance
			)
		);
	}

	/**
	 * Update a record
	 * @param  int $invoiceId
	 * @param  float $itemSubtotal
	 * @param  float $itemTaxTotal
	 * @param  float $taxTotal
	 * @param  float $total
	 * @param  float $paid
	 * @param  float $balance
	 * @return void
	 */
	public function update($invoiceId, $itemSubtotal, $itemTaxTotal, $taxTotal, $total, $paid, $balance)
	{
		$invoiceAmount = InvoiceAmount::where('invoice_id', $invoiceId)->first();

		$invoiceAmount->fill(
			array(
				'item_subtotal'  => $itemSubtotal,
				'item_tax_total' => $itemTaxTotal,
				'tax_total'      => $taxTotal,
				'total'          => $total,
				'paid'           => $paid,
				'balance'        => $balance
			)
		);
		
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