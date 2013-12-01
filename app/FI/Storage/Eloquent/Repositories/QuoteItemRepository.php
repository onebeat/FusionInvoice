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
	
	public function create($quoteId, $name, $description, $quantity, $price, $taxRateId, $displayOrder)
	{
		return QuoteItem::create(
			array(
				'quote_id'      => $quoteId,
				'name'          => $name,
				'description'   => $description,
				'quantity'      => NumberFormatter::unformat($quantity),
				'price'         => NumberFormatter::unformat($price),
				'tax_rate_id'   => $taxRateId,
				'display_order' => $displayOrder
				)
			)->id;
	}
	
	public function update($quoteItemId, $name, $description, $quantity, $price, $taxRateId, $displayOrder)
	{
		$quoteItem = QuoteItem::find($quoteItemId);

		$quoteItem->fill(
			array(
				'name'          => $name,
				'description'   => $description,
				'quantity'      => NumberFormatter::unformat($quantity),
				'price'         => NumberFormatter::unformat($price),
				'tax_rate_id'   => $taxRateId,
				'display_order' => $displayOrder
			)
		);
		
		$quoteItem->save();
	}
	
	public function delete($id)
	{
		$quoteItem = QuoteItem::find($id);

		$quoteItem->amount->delete();
		$quoteItem->delete();
	}
	
}