<?php namespace FI\Storage\Eloquent\Repositories;

use \FI\Storage\Eloquent\Models\InvoiceItemAmount;

class InvoiceItemAmountRepository implements \FI\Storage\Interfaces\InvoiceItemAmountRepositoryInterface {
	
	/**
	 * Get a single record
	 * @param  int $id
	 * @return InvoiceItemAmount
	 */
	public function find($id)
	{
		return InvoiceItemAmount::find($id);
	}

	/**
	 * Get a list of records by invoice id
	 * @param  int $invoiceId
	 * @return InvoiceItemAmount
	 */
	public function findByInvoiceId($invoiceId)
	{
		return \DB::table('invoice_item_amounts')
		->whereRaw('item_id IN (SELECT id FROM invoice_items WHERE invoice_id = ' . $invoiceId . ')')
		->get();
	}
	
	/**
	 * Create a record
	 * @param  int $itemId
	 * @param  float $subtotal
	 * @param  float $taxTotal
	 * @param  float $total
	 * @return void
	 */
	public function create($itemId, $subtotal, $taxTotal, $total)
	{
		InvoiceItemAmount::create(
			array(
				'item_id'   => $itemId,
				'subtotal'  => $subtotal,
				'tax_total' => $taxTotal,
				'total'     => $total
			)
		);
	}
	
	/**
	 * Update a record
	 * @param  int $itemId
	 * @param  float $subtotal
	 * @param  float $taxTotal
	 * @param  float $total
	 * @return void
	 */
	public function update($itemId, $subtotal, $taxTotal, $total)
	{
		$invoiceItemAmount = InvoiceItemAmount::where('item_id', $itemId)->first();

		$invoiceItemAmount->fill(
			array(
				'subtotal'  => $subtotal,
				'tax_total' => $taxTotal,
				'total'     => $total
			)
		);

		$invoiceItemAmount->save();
	}
	
	/**
	 * Delete a record
	 * @param  int $id
	 * @return void
	 */
	public function delete($id)
	{
		InvoiceItemAmount::destroy($id);
	}

	/**
	 * Delete a record based on the item id
	 * @param  int $itemId
	 * @return void
	 */
	public function deleteByItemId($itemId)
	{
		InvoiceItemAmount::where('item_id', $itemId)->delete();
	}
	
}