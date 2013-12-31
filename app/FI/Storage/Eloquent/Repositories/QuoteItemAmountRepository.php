<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Storage\Eloquent\Repositories;

use FI\Storage\Eloquent\Models\QuoteItemAmount;

class QuoteItemAmountRepository {
	
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
	 * @param  array $input
	 * @return int
	 */
	public function create($input)
	{
		return QuoteItemAmount::create($input)->id;
	}
	
	/**
	 * Update a record
	 * @param  array $input
	 * @param  int $itemId
	 * @return void
	 */
	public function update($input, $itemId)
	{
		$quoteItemAmount = QuoteItemAmount::where('item_id', $itemId)->first();

		$quoteItemAmount->fill($input);

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