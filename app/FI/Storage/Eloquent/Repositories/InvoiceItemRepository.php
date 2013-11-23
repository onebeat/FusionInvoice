<?php namespace FI\Storage\Eloquent\Repositories;

use \FI\Storage\Eloquent\Models\InvoiceItem;
use \FI\Storage\Eloquent\Models\InvoiceItemAmount;
use \FI\Classes\NumberFormatter;

class InvoiceItemRepository implements \FI\Storage\Interfaces\InvoiceItemRepositoryInterface {

	public function find($id)
	{
		return InvoiceItem::find($id);
	}

	public function findByInvoiceId($invoiceId)
	{
		return InvoiceItem::orderBy('display_order')->where('invoice_id', '=', $invoiceId)->get();
	}
	
	public function create($input)
	{
		// Unformat these numbers before they're stored
		$input['price']    = NumberFormatter::unformat($input['price']);
		$input['quantity'] = NumberFormatter::unformat($input['quantity']);
				
		return InvoiceItem::create($input)->id;
	}
	
	public function update($input, $id)
	{
		$invoiceItem = InvoiceItem::find($id);

		// Unformat these numbers before they're stored
		$input['price']    = NumberFormatter::unformat($input['price']);
		$input['quantity'] = NumberFormatter::unformat($input['quantity']);

		$invoiceItem->fill($input);
		$invoiceItem->save();
	}
	
	public function delete($id)
	{
		$invoiceItem = InvoiceItem::find($id);

		$invoiceItem->amount->delete();
		$invoiceItem->delete();
	}
	
}