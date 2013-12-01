<?php namespace FI\Storage\Eloquent\Repositories;

use FI\Storage\Eloquent\Models\ItemLookup;
use FI\Classes\NumberFormatter;

class ItemLookupRepository implements \FI\Storage\Interfaces\ItemLookupRepositoryInterface {
	
	public function all()
	{
		return ItemLookup::all();
	}

	public function getPaged($page = 1, $numPerPage = null)
	{
		\DB::getPaginator()->setCurrentPage($page);
		return ItemLookup::paginate($numPerPage ?: \Config::get('defaultNumPerPage'));
	}

	public function getByIds($ids)
	{
		return ItemLookup::whereIn('id', $ids)->get();
	}

	public function find($id)
	{
		return ItemLookup::find($id);
	}
	
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
	
	public function delete($id)
	{
		ItemLookup::destroy($id);
	}
	
}