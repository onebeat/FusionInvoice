<?php namespace FI\Storage\Interfaces;

interface InvoiceItemAmountRepositoryInterface {
	
	public function find($id);

	public function findByInvoiceId($invoiceId);
	
	public function create($itemId, $subtotal, $taxTotal, $total);
	
	public function update($itemId, $subtotal, $taxTotal, $total);
	
	public function delete($id);
	
}