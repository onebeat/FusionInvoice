<?php namespace FI\Storage\Interfaces;

interface QuoteAmountRepositoryInterface {
	
	public function find($id);
	
	public function create($quoteId, $itemSubtotal, $itemTaxTotal, $taxTotal, $total);
	
	public function update($quoteId, $itemSubtotal, $itemTaxTotal, $taxTotal, $total);

	public function delete($id);

}