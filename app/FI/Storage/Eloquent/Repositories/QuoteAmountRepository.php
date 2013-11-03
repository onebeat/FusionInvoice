<?php namespace FI\Storage\Eloquent\Repositories;

use \FI\Storage\Eloquent\Models\QuoteAmount;

class QuoteAmountRepository implements \FI\Storage\Interfaces\QuoteAmountRepositoryInterface {
	
	public function find($id)
	{
		return QuoteAmount::find($id);
	}
	
	public function create($input)
	{
		QuoteAmount::create($input);
	}
	
	public function update($input, $id)
	{
		$quoteAmount = QuoteAmount::find($id);
		$quoteAmount->fill($input);
		$quoteAmount->save();
	}
	
	public function delete($id)
	{
		QuoteAmount::destroy($id);
	}

	public function calculateQuoteAmount($quote_id)
	{
		$quoteItemAmount = \DB::table('quote_item_amounts')
		->select(\DB::raw('SUM(subtotal) AS item_subtotal, SUM(tax_total) AS item_tax_total'))
		->whereRaw('item_id IN (SELECT id FROM quote_items WHERE quote_id = ' . $quote_id . ')')
		->first();

		$record = array(
			'item_subtotal'  => $quoteItemAmount->item_subtotal,
			'item_tax_total' => $quoteItemAmount->item_tax_total,
			'total'          => $quoteItemAmount->item_subtotal + $quoteItemAmount->item_tax_total
		);

		$quoteAmount = QuoteAmount::where('quote_id', $quote_id)->first();
		$quoteAmount->fill($record);
		$quoteAmount->save();
	}
	
}