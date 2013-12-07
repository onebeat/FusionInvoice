<?php namespace FI\Storage\Eloquent\Repositories;

use FI\Storage\Eloquent\Models\InvoiceTaxRate;

class InvoiceTaxRateRepository implements \FI\Storage\Interfaces\InvoiceTaxRateRepositoryInterface {

	/**
	 * Get a single record
	 * @param  int $id
	 * @return InvoiceTaxRate
	 */
	public function find($id)
	{
		return InvoiceTaxRate::find($id);
	}

	/**
	 * Get a single record by invoice id
	 * @param  int $invoiceId
	 * @return InvoiceTaxRate
	 */
	public function findByInvoiceId($invoiceId)
	{
		return InvoiceTaxRate::where('invoice_id', $invoiceId)->get();
	}
	
	/**
	 * Create a record
	 * @param  int $invoiceId
	 * @param  int $taxRateId
	 * @param  bool $includeItemTax
	 * @param  float $taxTotal
	 * @return void
	 */
	public function create($invoiceId, $taxRateId, $includeItemTax, $taxTotal)
	{
		InvoiceTaxRate::create(
			array(
				'invoice_id'       => $invoiceId,
				'tax_rate_id'      => $taxRateId,
				'include_item_tax' => $includeItemTax,
				'tax_total'        => $taxTotal
			)
		);
	}
	
	/**
	 * Update a record
	 * @param  int $invoiceId
	 * @param  int $taxRateId
	 * @param  bool $includeItemTax
	 * @param  float $taxTotal
	 * @return void
	 */
	public function update($invoiceId, $taxRateId, $includeItemTax, $taxTotal)
	{
		$invoiceTaxRate = InvoiceTaxRate::where('invoice_id', $invoiceId)->where('tax_rate_id', $taxRateId)->first();

		$invoiceTaxRate->fill(
			array(
				'include_item_tax' => $includeItemTax,
				'tax_total'        => $taxTotal
			)
		);

		$invoiceTaxRate->save();
	}
	
	/**
	 * Delete a record
	 * @param  int $id
	 * @return void
	 */
	public function delete($id)
	{
		InvoiceTaxRate::destroy($id);
	}
	
}