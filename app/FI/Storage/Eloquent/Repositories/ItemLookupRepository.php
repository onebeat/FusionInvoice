<?php namespace FI\Storage\Eloquent\Repositories;

use FI\Storage\Eloquent\Models\ItemLookup;
use FI\Classes\NumberFormatter;

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
	 * @param  string $name
	 * @param  string $description
	 * @param  float $price
	 * @return void
	 */
	public function create($name, $description, $price)
	{
		ItemLookup::create(
			array(
				'name'        => $name,
				'description' => $description,
				'price'       => NumberFormatter::unformat($price)
			)
		);
	}
	
	/**
	 * Update a record
	 * @param  int $itemLookupId
	 * @param  string $name
	 * @param  string $description
	 * @param  float $price
	 * @return void
	 */
	public function update($itemLookupId, $name, $description, $price)
	{
		$itemLookup = ItemLookup::find($itemLookupId);

		$itemLookup->fill(
			array(
				'name'        => $name,
				'description' => $description,
				'price'       => NumberFormatter::unformat($price)
			)
		);
		
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