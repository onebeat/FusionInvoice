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
	
	public function create($input)
	{
		InvoiceTaxRate::create($input);
	}
	
	public function update($input, $id)
	{
		$invoiceTaxRate = InvoiceTaxRate::find($id);
		$invoiceTaxRate->fill($input);
		$invoiceTaxRate->save();
	}

	public function updateByInvoiceIdAndTaxRateId($input, $invoiceId, $taxRateId)
	{
		$invoiceTaxRate = InvoiceTaxRate::where('invoice_id', $invoiceId)->where('tax_rate_id', $taxRateId)->first();
		$invoiceTaxRate->fill($input);
		$invoiceTaxRate->save();
	}
	
	public function delete($id)
	{
		InvoiceTaxRate::destroy($id);
	}
	
}