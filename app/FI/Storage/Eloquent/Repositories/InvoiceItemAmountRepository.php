<?php namespace FI\Storage\Eloquent\Repositories;

use \FI\Storage\Eloquent\Models\InvoiceItemAmount;

class InvoiceItemAmountRepository implements \FI\Storage\Interfaces\InvoiceItemAmountRepositoryInterface {
	
	public function find($id)
	{
		return InvoiceItemAmount::find($id);
	}
	
	public function create($input)
	{
		InvoiceItemAmount::create($input);
	}
	
	public function update($input, $id)
	{
		$invoiceItemAmount = InvoiceItemAmount::find($id);
		$$invoiceItemAmount->fill($input);
		$$invoiceItemAmount->save();
	}
	
	public function delete($id)
	{
		InvoiceItemAmount::destroy($id);
	}
	
}