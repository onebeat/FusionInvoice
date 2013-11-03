<?php namespace FI\Storage\Eloquent\Repositories;

use \FI\Storage\Eloquent\Models\QuoteItem;

class QuoteItemRepository implements \FI\Storage\Interfaces\QuoteItemRepositoryInterface {

	public function find($id)
	{
		return QuoteItem::find($id);
	}

	public function findByQuoteId($quote_id)
	{
		return QuoteItem::where('quote_id', $quote_id)->get();
	}
	
	public function create($input)
	{
		$quoteItem = QuoteItem::create($input);

		\Event::fire('quoteItem.created', array($quoteItem));

		return $quoteItem->id;
	}
	
	public function update($input, $id)
	{
		$quoteItem = QuoteItem::find($id);
		$quoteItem->fill($input);
		$quoteItem->save();

		\Event::fire('quoteItem.updated', array($quoteItem));
	}
	
	public function delete($id)
	{
		QuoteItem::destroy($id);
	}
	
}