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
	
	public function create($input)
	{
		QuoteTaxRate::create($input);
	}
	
	public function update($input, $id)
	{
		$quoteTaxRate = QuoteTaxRate::find($id);
		$quoteTaxRate->fill($input);
		$quoteTaxRate->save();
	}

	public function updateByQuoteIdAndTaxRateId($input, $quoteId, $taxRateId)
	{
		$quoteTaxRate = QuoteTaxRate::where('quote_id', $quoteId)->where('tax_rate_id', $taxRateId)->first();
		$quoteTaxRate->fill($input);
		$quoteTaxRate->save();
	}
	
	public function delete($id)
	{
		QuoteTaxRate::destroy($id);
	}
	
}