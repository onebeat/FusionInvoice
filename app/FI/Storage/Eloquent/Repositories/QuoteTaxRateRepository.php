<?php namespace FI\Storage\Eloquent\Repositories;

use \FI\Storage\Eloquent\Models\QuoteTaxRate;

class QuoteTaxRateRepository implements \FI\Storage\Interfaces\QuoteTaxRateRepositoryInterface {

	public function find($id)
	{
		return QuoteTaxRate::find($id);
	}

	public function findByQuoteId($quoteId)
	{
		return QuoteTaxRate::where('quote_id', $quoteId)->get();
	}

	public function create($quoteId, $taxRateId, $includeItemTax, $taxTotal)
	{
		QuoteTaxRate::create(
			array(
				'quote_id'         => $quoteId,
				'tax_rate_id'      => $taxRateId,
				'include_item_tax' => $includeItemTax,
				'tax_total'        => $taxTotal
			)
		);
	}
	
	public function update($quoteId, $taxRateId, $includeItemTax, $taxTotal)
	{
		$quoteTaxRate = QuoteTaxRate::where('quote_id', $quoteId)->where('tax_rate_id', $taxRateId)->first();

		$quoteTaxRate->fill(
			array(
				'include_item_tax' => $includeItemTax,
				'tax_total'        => $taxTotal
			)
		);

		$quoteTaxRate->save();
	}

	public function delete($id)
	{
		QuoteTaxRate::destroy($id);
	}
	
}