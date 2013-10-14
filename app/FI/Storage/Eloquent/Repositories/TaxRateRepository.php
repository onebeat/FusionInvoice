<?php namespace FI\Storage\Eloquent\Repositories;

use \FI\Storage\Eloquent\Models\TaxRate;

class TaxRateRepository implements \FI\Storage\Interfaces\TaxRateRepositoryInterface {
	
	public function all()
	{
		return TaxRate::all();
	}

public function getPaged($page = 1, $numPerPage = 15)
	{
		\DB::getPaginator()->setCurrentPage($page);
		return TaxRate::orderBy('name')->paginate($numPerPage);
	}

	public function find($id)
	{
		return TaxRate::find($id);
	}
	
	public function create($input)
	{
		TaxRate::create($input);
	}
	
	public function update($input, $id)
	{
		$tax_rate = TaxRate::find($id);
		$tax_rate->fill($input);
		$tax_rate->save();
	}
	
	public function delete($id)
	{
		TaxRate::destroy($id);
	}
	
}