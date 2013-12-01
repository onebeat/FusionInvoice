<?php namespace FI\Storage\Eloquent\Repositories;

use \FI\Storage\Eloquent\Models\QuoteItemAmount;

class QuoteItemAmountRepository implements \FI\Storage\Interfaces\QuoteItemAmountRepositoryInterface {
	
	public function find($id)
	{
		return QuoteItemAmount::find($id);
	}

	public function findByQuoteId($quoteId)
	{
		return \DB::table('quote_item_amounts')
		->whereRaw('item_id IN (SELECT id FROM quote_items WHERE quote_id = ' . $quoteId . ')')
		->get();
	}
	
	public function create($itemId, $subtotal, $taxTotal, $total)
	{
		QuoteItemAmount::create(
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
		$quoteItemAmount = QuoteItemAmount::where('item_id', $itemId)->first();

		$quoteItemAmount->fill(
			array(
				'subtotal'  => $subtotal,
				'tax_total' => $taxTotal,
				'total'     => $total
			)
		);

		$quoteItemAmount->save();
	}
	
	public function delete($id)
	{
		QuoteItemAmount::destroy($id);
	}

	public function deleteByItemId($itemId)
	{
		QuoteItemAmount::where('item_id', $itemId)->delete();
	}
	
}