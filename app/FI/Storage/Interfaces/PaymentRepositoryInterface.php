<?php namespace FI\Storage\Interfaces;

interface PaymentRepositoryInterface {
	
	public function all();

	public function getPaged($page, $numPerPage);

	public function getTotalPaidByInvoiceId($invoiceId);
	
	public function find($id);
	
	public function create($invoiceId, $amount, $paidAt, $paymentMethodId, $note);
	
	public function update($paymentId, $amount, $paidAt, $paymentMethodId, $note);
	
	public function delete($id);
	
}