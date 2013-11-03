<?php namespace FI\Storage\Interfaces;

interface QuoteItemRepositoryInterface {
	
	public function find($id);

	public function findByQuoteId($quote_id);
	
	public function create($input);
	
	public function update($input, $id);
	
	public function delete($id);
	
}