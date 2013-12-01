<?php namespace FI\Storage\Interfaces;

interface QuoteTaxRateRepositoryInterface {
	
	public function find($id);

	public function findByQuoteId($quoteId);
	
	public function create($invoiceId, $taxRateId, $includeItemTax, $taxTotal);
	
	public function update($invoiceId, $taxRateId, $includeItemTax, $taxTotal);

	public function delete($id);
	
}