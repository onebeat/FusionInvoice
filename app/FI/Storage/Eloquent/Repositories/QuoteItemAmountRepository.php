<?php namespace FI\Storage\Eloquent\Repositories;

use \FI\Storage\Eloquent\Models\QuoteItemAmount;

class QuoteItemAmountRepository implements \FI\Storage\Interfaces\QuoteItemAmountRepositoryInterface {
	
	public function find($id)
	{
		return QuoteItemAmount::find($id);
	}

	public function findByQuoteId($quote_id)
	{
		return \DB::table('quote_item_amounts')
		->whereRaw('item_id IN (SELECT id FROM quote_items WHERE quote_id = ' . $quote_id . ')')
		->get();
	}
	
	public function create($input)
	{
		QuoteItemAmount::create($input);
	}
	
	public function update($input, $id)
	{
		$quoteItemAmount = QuoteItemAmount::find($id);
		$quoteItemAmount->fill($input);
		$quoteItemAmount->save();
	}

	public function updateByItemId($input, $itemId)
	{
		$quoteItemAmount = QuoteItemAmount::where('item_id', $itemId)->first();
		$quoteItemAmount->fill($input);
		$quoteItemAmount->save();
	}
	
	public function delete($id)
	{
		QuoteItemAmount::destroy($id);
	}
	
}