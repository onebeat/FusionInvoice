<?php namespace FI\Storage\Eloquent\Repositories;

use FI\Storage\Eloquent\Models\ItemLookup;

class ItemLookupRepository implements \FI\Storage\Interfaces\ItemLookupRepositoryInterface {
	
	/**
	 * Get a list of all records
	 * @return ItemLookup
	 */
	public function all()
	{
		return ItemLookup::all();
	}

	/**
	 * Get a paged list of records
	 * @param  int $page
	 * @param  int  $numPerPage
	 * @return ItemLookup
	 */
	public function getPaged($page = 1, $numPerPage = null)
	{
		\DB::getPaginator()->setCurrentPage($page);
		return ItemLookup::paginate($numPerPage ?: \Config::get('defaultNumPerPage'));
	}

	/**
	 * Get a list of records by id
	 * @param  array $ids
	 * @return ItemLookup
	 */
	public function getByIds($ids)
	{
		return ItemLookup::whereIn('id', $ids)->get();
	}

	/**
	 * Get a single record
	 * @param  int $id
	 * @return ItemLookup
	 */
	public function find($id)
	{
		return ItemLookup::find($id);
	}
	
	/**
	 * Create a record
	 * @param  array $input
	 * @return int
	 */
	public function create($input)
	{
		return ItemLookup::create($input)->id;
	}
	
	/**
	 * Update a record
	 * @param  array $input
	 * @param  int $id
	 * @return void
	 */
	public function update($input, $id)
	{
		$itemLookup = ItemLookup::find($id);

		$itemLookup->fill($input);
		
		$itemLookup->save();
	}
	
	/**
	 * Delete a record
	 * @param  int $id
	 * @return void
	 */
	public function delete($id)
	{
		ItemLookup::destroy($id);
	}
	
}