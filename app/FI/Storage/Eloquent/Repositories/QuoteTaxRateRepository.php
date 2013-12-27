<?php namespace FI\Storage\Eloquent\Repositories;

use FI\Storage\Eloquent\Models\QuoteTaxRate;

class QuoteTaxRateRepository {

	/**
	 * Get a single record
	 * @param  int $id
	 * @return QuoteTaxRate
	 */
	public function find($id)
	{
		return QuoteTaxRate::find($id);
	}

	/**
	 * Get a list of tax rates by quote id
	 * @param  int $quoteId
	 * @return QutoeTaxRate
	 */
	public function findByQuoteId($quoteId)
	{
		return QuoteTaxRate::where('quote_id', $quoteId)->get();
	}

	/**
	 * Create a record
	 * @param  array $input
	 * @return int
	 */
	public function create($input)
	{
		return QuoteTaxRate::create($input)->id;
	}
	
	/**
	 * Update a record
	 * @param  array $input
	 * @param  int $quoteId
	 * @param  int $taxRateId
	 * @return void
	 */
	public function update($input, $quoteId, $taxRateId)
	{
		$quoteTaxRate = QuoteTaxRate::where('quote_id', $quoteId)->where('tax_rate_id', $taxRateId)->first();

		$quoteTaxRate->fill($input);

		$quoteTaxRate->save();
	}

	/**
	 * Delete a record
	 * @param  int $id
	 * @return void
	 */
	public function delete($id)
	{
		QuoteTaxRate::destroy($id);
	}
	
}