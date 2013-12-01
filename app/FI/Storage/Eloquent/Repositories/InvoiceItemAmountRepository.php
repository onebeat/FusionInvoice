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
	
	public function delete($id)
	{
		InvoiceItemAmount::destroy($id);
	}

	public function deleteByItemId($itemId)
	{
		InvoiceItemAmount::where('item_id', $itemId)->delete();
	}
	
}