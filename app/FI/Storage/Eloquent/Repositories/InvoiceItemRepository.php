<?php namespace FI\Storage\Eloquent\Repositories;

use \FI\Storage\Eloquent\Models\InvoiceItem;

class InvoiceItemRepository implements \FI\Storage\Interfaces\InvoiceItemRepositoryInterface {
	
	public function find($id)
	{
		return InvoiceItem::find($id);
	}
	
	public function create($input)
	{
		InvoiceItem::create($input);
	}
	
	public function update($input, $id)
	{
		$invoiceItem = InvoiceItem::find($id);
		$invoiceItem->fill($input);
		$invoiceItem->save();
	}
	
	public function delete($id)
	{
		InvoiceItem::destroy($id);
	}
	
}