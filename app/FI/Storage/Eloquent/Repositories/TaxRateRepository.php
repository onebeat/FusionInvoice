<?php namespace FI\Storage\Eloquent\Repositories;

use FI\Storage\Eloquent\Models\TaxRate;
use FI\Classes\NumberFormatter;

class TaxRateRepository implements \FI\Storage\Interfaces\TaxRateRepositoryInterface {
	
	/**
	 * Get a list of all records
	 * @return TaxRate
	 */
	public function all()
	{
		return TaxRate::all();
	}

	/**
	 * Get a paged list of records
	 * @param  int $page
	 * @param  int  $numPerPage
	 * @return TaxRate
	 */
	public function getPaged($page = 1, $numPerPage = null)
	{
		\DB::getPaginator()->setCurrentPage($page);
		return TaxRate::orderBy('name')->paginate($numPerPage ?: \Config::get('defaultNumPerPage'));
	}

	/**
	 * Get a single record
	 * @param  int $id
	 * @return TaxRate
	 */
	public function find($id)
	{
		return TaxRate::find($id);
	}

	/**
	 * Get a list of records formatted for dropdown
	 * @return array
	 */
	public function lists()
	{
		return array_merge(array('0' => trans('fi.none')), TaxRate::lists('name', 'id'));
	}
	
	/**
	 * Create a record
	 * @param  string $name
	 * @param  float $percent
	 * @return void
	 */
	public function create($name, $percent)
	{
		TaxRate::create(
			array(
				'name'    => $name,
				'percent' => NumberFormatter::unformat($percent)
			)
		);
	}
	
	/**
	 * Update a record
	 * @param  int $id
	 * @param  string $name
	 * @param  float $percent
	 * @return void
	 */
	public function update($id, $name, $percent)
	{
		$taxRate = TaxRate::find($id);

		$taxRate->fill(
			array(
				'name'    => $name,
				'percent' => NumberFormatter::unformat($percent)
			)
		);

		$taxRate->save();
	}
	
	/**
	 * Delete a record
	 * @param  int $id
	 * @return void
	 */
	public function delete($id)
	{
		TaxRate::destroy($id);
	}
	
}