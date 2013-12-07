<?php namespace FI\Storage\Eloquent\Repositories;

use FI\Storage\Eloquent\Models\InvoiceItem;
use FI\Storage\Eloquent\Models\InvoiceItemAmount;
use FI\Classes\NumberFormatter;

class InvoiceItemRepository implements \FI\Storage\Interfaces\InvoiceItemRepositoryInterface {

	/**
	 * Get a single record
	 * @param  int $id
	 * @return InvoiceItem
	 */
	public function find($id)
	{
		return InvoiceItem::find($id);
	}

	/**
	 * Get a list of records by invoice id
	 * @param  int $invoiceId
	 * @return InvoiceItem
	 */
	public function findByInvoiceId($invoiceId)
	{
		return InvoiceItem::orderBy('display_order')->where('invoice_id', '=', $invoiceId)->get();
	}

	/**
	 * Create a record
	 * @param  int $invoiceId
	 * @param  string $name
	 * @param  string $description
	 * @param  float $quantity
	 * @param  float $price
	 * @param  int $taxRateId
	 * @param  int $displayOrder
	 * @return int
	 */
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

	/**
	 * Update a record
	 * @param  int $invoiceItemId
	 * @param  string $name
	 * @param  string $description
	 * @param  float $quantity
	 * @param  float $price
	 * @param  int $taxRateId
	 * @param  int $displayOrder
	 * @return void
	 */
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
	
	/**
	 * Delete a record
	 * @param  int $id
	 * @return void
	 */
	public function delete($id)
	{
		$invoiceItem = InvoiceItem::find($id);

		$invoiceItem->amount->delete();
		$invoiceItem->delete();
	}
	
}