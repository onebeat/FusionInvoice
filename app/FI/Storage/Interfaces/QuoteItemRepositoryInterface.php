<?php namespace FI\Storage\Interfaces;

interface QuoteItemRepositoryInterface {
	
	public function find($id);

	public function findByQuoteId($quoteId);
	
	public function create($quoteId, $name, $description, $quantity, $price, $taxRateId, $displayOrder);
	
	public function update($quoteItemId, $name, $description, $quantity, $price, $taxRateId, $displayOrder);
	
	public function delete($id);
}