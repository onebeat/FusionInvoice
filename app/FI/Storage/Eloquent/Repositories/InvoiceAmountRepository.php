<?php namespace FI\Storage\Eloquent\Repositories;

use \FI\Storage\Eloquent\Models\InvoiceAmount;

class InvoiceAmountRepository implements \FI\Storage\Interfaces\InvoiceAmountRepositoryInterface {
	
	public function find($id)
	{
		return InvoiceAmount::find($id);
	}
	
	public function create($input)
	{
		InvoiceAmount::create($input);
	}
	
	public function update($input, $id)
	{
		$invoiceAmount = InvoiceAmount::find($id);
		$invoiceAmount->fill($input);
		$invoiceAmount->save();
	}

	public function updateByInvoiceId($input, $invoiceId)
	{
		$invoiceAmount = InvoiceAmount::where('invoice_id', $invoiceId)->first();
		$invoiceAmount->fill($input);
		$invoiceAmount->save();
	}

	public function applyPaymentToBalance($paymentAmount, $invoiceId)
	{
		$invoiceAmount          = InvoiceAmount::where('invoice_id', $invoiceId)->first();
		$invoiceAmount->paid    = $invoiceAmount->paid + $paymentAmount;
		$invoiceAmount->balance = $invoiceAmount->total - $invoiceAmount->paid;
		$invoiceAmount->save();
	}
	
	public function delete($id)
	{
		InvoiceAmount::destroy($id);
	}
}