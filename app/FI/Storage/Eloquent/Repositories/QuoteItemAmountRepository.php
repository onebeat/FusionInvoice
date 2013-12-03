<?php namespace FI\Storage\Eloquent\Repositories;

use \FI\Storage\Eloquent\Models\QuoteItemAmount;

class QuoteItemAmountRepository implements \FI\Storage\Interfaces\QuoteItemAmountRepositoryInterface {
	
	/**
	 * Find a record
	 * @param  int $id
	 * @return QuoteItemAmount
	 */
	public function find($id)
	{
		return QuoteItemAmount::find($id);
	}

	/**
	 * Find all records by quote id
	 * @param  int $quoteId [description]
	 * @return QuoteItemAmount
	 */
	public function findByQuoteId($quoteId)
	{
		return \DB::table('quote_item_amounts')
		->whereRaw('item_id IN (SELECT id FROM quote_items WHERE quote_id = ' . $quoteId . ')')
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
		QuoteItemAmount::create(
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
	
	/**
	 * Delete a record
	 * @param  int $id
	 * @return void
	 */
	public function delete($id)
	{
		QuoteItemAmount::destroy($id);
	}

	/**
	 * Delete a record by item id
	 * @param  int $itemId
	 * @return void
	 */
	public function deleteByItemId($itemId)
	{
		QuoteItemAmount::where('item_id', $itemId)->delete();
	}
	
}