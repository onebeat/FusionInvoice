<?php namespace FI\Storage\Eloquent\Repositories;

use FI\Storage\Eloquent\Models\QuoteItem;
use FI\Storage\Eloquent\Models\QuoteItemAmount;

class QuoteItemRepository implements \FI\Storage\Interfaces\QuoteItemRepositoryInterface {

	/**
	 * Get a single record
	 * @param  int $id
	 * @return QuoteItem
	 */
	public function find($id)
	{
		return QuoteItem::find($id);
	}

	/**
	 * Get a list of records by quote id
	 * @param  int $quoteId
	 * @return QuoteItem
	 */
	public function findByQuoteId($quoteId)
	{
		return QuoteItem::orderBy('display_order')->where('quote_id', '=', $quoteId)->get();
	}
	
	/**
	 * Create a record
	 * @param  array $input
	 * @return int
	 */
	public function create($input)
	{
		return QuoteItem::create($input)->id;
	}
	
	/**
	 * Update a record
	 * @param  array $input
	 * @param  int $id
	 * @return void
	 */
	public function update($input, $id)
	{
		$quoteItem = QuoteItem::find($id);

		$quoteItem->fill($input);
		
		$quoteItem->save();
	}
	
	/**
	 * Delete a record
	 * @param  int $id
	 * @return string
	 */
	public function delete($id)
	{
		$quoteItem = QuoteItem::find($id);

		$quoteItem->amount->delete();
		$quoteItem->delete();
	}
	
}