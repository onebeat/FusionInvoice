<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Quotes\Repositories;

use Event;

use FI\Modules\Quotes\Models\QuoteItem;
use FI\Modules\Quotes\Models\QuoteItemAmount;

class QuoteItemRepository {

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
		$id = QuoteItem::create($input)->id;

		Event::fire('quote.item.created', $id);

		return $id;
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

		$quoteId = $quoteItem->quote_id;

		$quoteItem->amount->delete();
		$quoteItem->delete();

		\Event::fire('quote.modified', $quoteId);
	}
	
}