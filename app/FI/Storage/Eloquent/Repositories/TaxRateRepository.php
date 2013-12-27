<?php namespace FI\Storage\Eloquent\Repositories;

use FI\Storage\Eloquent\Models\TaxRate;

class TaxRateRepository {
	
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
	 * @param  array $input
	 * @return int
	 */
	public function create($input)
	{
		return TaxRate::create($input)->id;
	}
	
	/**
	 * Update a record
	 * @param  array $input
	 * @param  int $id
	 * @return void
	 */
	public function update($input, $id)
	{
		$taxRate = TaxRate::find($id);

		$taxRate->fill($input);

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