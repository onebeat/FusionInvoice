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
	 * @param  array $input
	 * @return int
	 */
	public function create($input)
	{
		return InvoiceTaxRate::create($input)->id;
	}
	
	/**
	 * Update a record
	 * @param  array $input
	 * @param  int $invoiceId
	 * @param  int $taxRateId
	 * @return void
	 */
	public function update($input, $invoiceId, $taxRateId)
	{
		$invoiceTaxRate = InvoiceTaxRate::where('invoice_id', $invoiceId)->where('tax_rate_id', $taxRateId)->first();

		$invoiceTaxRate->fill($input);

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