<?php namespace FI\Storage\Eloquent\Repositories;

use FI\Storage\Eloquent\Models\QuoteItem;
use FI\Storage\Eloquent\Models\QuoteItemAmount;
use FI\Classes\NumberFormatter;

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
	 * @param  int $quoteId
	 * @param  string $name
	 * @param  string $description
	 * @param  float $quantity
	 * @param  float $price
	 * @param  int $taxRateId
	 * @param  int $displayOrder
	 * @return int
	 */
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
	
	/**
	 * Update a record
	 * @param  int $quoteItemId
	 * @param  string $name
	 * @param  string $description
	 * @param  float $quantity
	 * @param  float $price
	 * @param  int $taxRateId
	 * @param  int $displayOrder
	 * @return void
	 */
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