<?php namespace FI\Storage\Eloquent\Repositories;

use \FI\Storage\Eloquent\Models\QuoteTaxRate;

class QuoteTaxRateRepository implements \FI\Storage\Interfaces\QuoteTaxRateRepositoryInterface {

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
	 * @param  int $quoteId
	 * @param  int $taxRateId
	 * @param  bool $includeItemTax
	 * @param  float $taxTotal
	 * @return void
	 */
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
	
	/**
	 * Update a record
	 * @param  int $quoteId
	 * @param  int $taxRateId
	 * @param  bool $includeItemTax
	 * @param  float $taxTotal
	 * @return void
	 */
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