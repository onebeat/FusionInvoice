<?php namespace FI\Storage\Interfaces;

interface InvoiceAmountRepositoryInterface {

	public function find($id);
	
	public function create($invoiceId, $itemSubtotal, $itemTaxTotal, $taxTotal, $total, $paid, $balance);
	
	public function update($invoiceId, $itemSubtotal, $itemTaxTotal, $taxTotal, $total, $paid, $balance);

	public function delete($id);
	
}