<?php namespace FI\Storage\Eloquent\Repositories;

use \FI\Storage\Eloquent\Models\ItemLookup;

class ItemLookupRepository implements \FI\Storage\Interfaces\ItemLookupRepositoryInterface {
	
	public function all()
	{
		return ItemLookup::all();
	}

	public function getPaged($page = 1, $numPerPage = 15)
	{
		\DB::getPaginator()->setCurrentPage($page);
		return ItemLookup::paginate($numPerPage);
	}

	public function find($id)
	{
		return ItemLookup::find($id);
	}
	
	public function create($input)
	{
		ItemLookup::create($input);
	}
	
	public function update($input, $id)
	{
		$itemLookup = ItemLookup::find($id);
		$itemLookup->fill($input);
		$itemLookup->save();
	}
	
	public function delete($id)
	{
		ItemLookup::destroy($id);
	}
	
}