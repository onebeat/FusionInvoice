<?php namespace FI\Storage\Interfaces;

interface InvoiceItemAmountRepositoryInterface {
	
	public function find($id);
	
	public function create($input);
	
	public function update($input, $id);
	
	public function delete($id);
	
}