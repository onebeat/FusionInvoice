<?php namespace FI\Storage\Interfaces;

interface QuoteAmountRepositoryInterface {
	
	public function find($id);
	
	public function create($input);
	
	public function update($input, $id);

	public function updateByQuoteId($input, $quoteId);
	
	public function delete($id);

}