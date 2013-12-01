<?php namespace FI\Storage\Interfaces;

interface QuoteItemAmountRepositoryInterface {
	
	public function find($id);

	public function findByQuoteId($quoteId);
	
	public function create($itemId, $subtotal, $taxTotal, $total);
	
	public function update($itemId, $subtotal, $taxTotal, $total);
	
	public function delete($id);
	
}