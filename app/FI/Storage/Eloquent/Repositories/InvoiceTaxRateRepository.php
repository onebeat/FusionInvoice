<?php namespace FI\Storage\Eloquent\Repositories;

use \FI\Storage\Eloquent\Models\InvoiceTaxRate;

class InvoiceTaxRateRepository implements \FI\Storage\Interfaces\InvoiceTaxRateRepositoryInterface {

	public function find($id)
	{
		return InvoiceTaxRate::find($id);
	}

	public function findByInvoiceId($invoiceId)
	{
		return InvoiceTaxRate::where('invoice_id', $invoiceId)->get();
	}
	
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
	
	public function delete($id)
	{
		InvoiceTaxRate::destroy($id);
	}
	
}