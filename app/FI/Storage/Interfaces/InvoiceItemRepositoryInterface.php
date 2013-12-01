<?php namespace FI\Storage\Interfaces;

interface InvoiceItemRepositoryInterface {
	
	public function find($id);

	public function findByInvoiceId($invoiceId);
	
	public function create($invoiceId, $name, $description, $quantity, $price, $taxRateId, $displayOrder);
	
	public function update($invoiceItemId, $name, $description, $quantity, $price, $taxRateId, $displayOrder);
	
	public function delete($id);
	
}