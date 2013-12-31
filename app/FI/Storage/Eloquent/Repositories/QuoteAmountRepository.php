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

use FI\Classes\CurrencyFormatter;
use FI\Storage\Eloquent\Models\QuoteAmount;

class QuoteAmountRepository {
	
	/**
	 * Get a single record
	 * @param  int $id
	 * @return QuoteAmount
	 */
	public function find($id)
	{
		return QuoteAmount::find($id);
	}
	
	/**
	 * Create a record
	 * @param  array $input
	 * @return int
	 */
	public function create($input)
	{
		return QuoteAmount::create($input)->id;
	}
	
	/**
	 * Update a record
	 * @param  array $input
	 * @param  int $quoteId
	 * @return void
	 */
	public function update($input, $quoteId)
	{
		$quoteAmount = QuoteAmount::where('quote_id', $quoteId)->first();

		$quoteAmount->fill($input);

		$quoteAmount->save();
	}
	
	/**
	 * Delete a record
	 * @param  int $id
	 * @return void
	 */
	public function delete($id)
	{
		QuoteAmount::destroy($id);
	}

	/**
	 * Get a grouped list of amounts by status
	 * @param  array $statuses
	 * @return array
	 */
	public function getTotalsByStatus($statuses)
	{
		$amounts = array();

		foreach ($statuses as $key => $status)
		{
			$amounts[$key] = CurrencyFormatter::format(0);
		}

		$quoteAmounts = QuoteAmount::select('quotes.quote_status_id', \DB::raw('SUM(quote_amounts.total) AS total'))
		->join('quotes', 'quotes.id', '=', 'quote_amounts.quote_id')
		->groupBy('quotes.quote_status_id')
		->get();

		foreach ($quoteAmounts as $quoteAmount)
		{
			$amounts[$quoteAmount->quote_status_id] = CurrencyFormatter::format($quoteAmount->total);
		}

		return $amounts;
	}
}