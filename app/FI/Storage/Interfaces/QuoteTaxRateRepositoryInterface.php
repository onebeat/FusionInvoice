<?php namespace FI\Storage\Interfaces;

interface QuoteTaxRateRepositoryInterface {
	
	public function find($id);

	public function findByQuoteId($quoteId);
	
	public function create($input);
	
	public function update($input, $id);

	public function updateByQuoteIdAndTaxRateId($input, $quoteId, $taxRateId);
	
	public function delete($id);
	
}