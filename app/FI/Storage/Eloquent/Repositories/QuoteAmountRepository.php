<?php namespace FI\Storage\Eloquent\Repositories;

use FI\Classes\CurrencyFormatter;
use FI\Storage\Eloquent\Models\QuoteAmount;

class QuoteAmountRepository implements \FI\Storage\Interfaces\QuoteAmountRepositoryInterface {
	
	/**
	 * Get a single record
	 * @param  int $id
	 * @return QuoteAmount
	 */
	public function find($id)
	{
		return QuoteAmount::find($id);
	}
	
	public function create($quoteId, $itemSubtotal, $itemTaxTotal, $taxTotal, $total)
	{
		QuoteAmount::create(
			array(
				'quote_id'       => $quoteId,
				'item_subtotal'  => $itemSubtotal,
				'item_tax_total' => $itemTaxTotal,
				'tax_total'      => $taxTotal,
				'total'          => $total
			)
		);
	}
	
	/**
	 * Update a record
	 * @param  int $quoteId
	 * @param  float $itemSubtotal
	 * @param  float $itemTaxTotal
	 * @param  float $taxTotal
	 * @param  float $total
	 * @return void
	 */
	public function update($quoteId, $itemSubtotal, $itemTaxTotal, $taxTotal, $total)
	{
		$quoteAmount = QuoteAmount::where('quote_id', $quoteId)->first();

		$quoteAmount->fill(
			array(
				'item_subtotal'  => $itemSubtotal,
				'item_tax_total' => $itemTaxTotal,
				'tax_total'      => $taxTotal,
				'total'          => $total
			)
		);

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