<?php namespace FI\Storage\Eloquent\Repositories;

use \FI\Storage\Eloquent\Models\QuoteItem;
use \FI\Storage\Eloquent\Models\QuoteItemAmount;
use \FI\Classes\NumberFormatter;

class QuoteItemRepository implements \FI\Storage\Interfaces\QuoteItemRepositoryInterface {

	public function find($id)
	{
		return QuoteItem::find($id);
	}

	public function findByQuoteId($quoteId)
	{
		return QuoteItem::orderBy('display_order')->where('quote_id', '=', $quoteId)->get();
	}
	
	public function create($input)
	{
		// Unformat these numbers before they're stored
		$input['price']    = NumberFormatter::unformat($input['price']);
		$input['quantity'] = NumberFormatter::unformat($input['quantity']);
		
		return QuoteItem::create($input)->id;
	}
	
	public function update($input, $id)
	{
		$quoteItem = QuoteItem::find($id);

		// Unformat these numbers before they're stored
		$input['price']    = NumberFormatter::unformat($input['price']);
		$input['quantity'] = NumberFormatter::unformat($input['quantity']);

		$quoteItem->fill($input);
		$quoteItem->save();
	}
	
	public function delete($id)
	{
		$quoteItem = QuoteItem::find($id);

		$quoteItem->amount->delete();
		$quoteItem->delete();
	}
	
}