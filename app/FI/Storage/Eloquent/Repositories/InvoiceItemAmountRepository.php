<?php namespace FI\Storage\Eloquent\Repositories;

use \FI\Storage\Eloquent\Models\InvoiceItemAmount;

class InvoiceItemAmountRepository implements \FI\Storage\Interfaces\InvoiceItemAmountRepositoryInterface {
	
	public function find($id)
	{
		return InvoiceItemAmount::find($id);
	}

	public function findByInvoiceId($invoiceId)
	{
		return \DB::table('invoice_item_amounts')
		->whereRaw('item_id IN (SELECT id FROM invoice_items WHERE invoice_id = ' . $invoiceId . ')')
		->get();
	}
	
	public function create($input)
	{
		InvoiceItemAmount::create($input);
	}
	
	public function update($input, $id)
	{
		$invoiceItemAmount = InvoiceItemAmount::find($id);
		$invoiceItemAmount->fill($input);
		$invoiceItemAmount->save();
	}

	public function updateByItemId($input, $itemId)
	{
		$invoiceItemAmount = InvoiceItemAmount::where('item_id', $itemId)->first();
		$invoiceItemAmount->fill($input);
		$invoiceItemAmount->save();
	}
	
	public function delete($id)
	{
		InvoiceItemAmount::destroy($id);
	}

	public function deleteByItemId($itemId)
	{
		InvoiceItemAmount::where('item_id', $itemId)->delete();
	}
	
}