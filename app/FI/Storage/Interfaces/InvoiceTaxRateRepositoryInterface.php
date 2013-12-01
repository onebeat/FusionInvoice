<?php namespace FI\Storage\Interfaces;

interface InvoiceTaxRateRepositoryInterface {

	public function find($id);
	
	public function create($invoiceId, $taxRateId, $includeItemTax, $taxTotal);
	
	public function update($invoiceId, $taxRateId, $includeItemTax, $taxTotal);
	
	public function delete($id);
	
}