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

	public function create($invoiceId, $name, $description, $quantity, $price, $taxRateId, $displayOrder)
	{
		return InvoiceItem::create(
			array(
				'invoice_id'    => $invoiceId,
				'name'          => $name,
				'description'   => $description,
				'quantity'      => NumberFormatter::unformat($quantity),
				'price'         => NumberFormatter::unformat($price),
				'tax_rate_id'   => $taxRateId,
				'display_order' => $displayOrder
				)
			)->id;
	}

	public function update($invoiceItemId, $name, $description, $quantity, $price, $taxRateId, $displayOrder)
	{
		$invoiceItem = InvoiceItem::find($invoiceItemId);

		$invoiceItem->fill(
			array(
				'name'          => $name,
				'description'   => $description,
				'quantity'      => NumberFormatter::unformat($quantity),
				'price'         => NumberFormatter::unformat($price),
				'tax_rate_id'   => $taxRateId,
				'display_order' => $displayOrder
				)
			);
		
		$invoiceItem->save();
	}
	
	public function delete($id)
	{
		$invoiceItem = InvoiceItem::find($id);

		$invoiceItem->amount->delete();
		$invoiceItem->delete();
	}
	
}