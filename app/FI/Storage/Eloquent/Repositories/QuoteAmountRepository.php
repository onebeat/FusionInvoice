<?php namespace FI\Storage\Eloquent\Repositories;

use \FI\Storage\Eloquent\Models\QuoteAmount;

class QuoteAmountRepository implements \FI\Storage\Interfaces\QuoteAmountRepositoryInterface {
	
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
	
	public function delete($id)
	{
		QuoteAmount::destroy($id);
	}
}