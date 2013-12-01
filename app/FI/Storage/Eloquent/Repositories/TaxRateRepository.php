<?php namespace FI\Storage\Eloquent\Repositories;

use \FI\Storage\Eloquent\Models\TaxRate;

class TaxRateRepository implements \FI\Storage\Interfaces\TaxRateRepositoryInterface {
	
	public function all()
	{
		return TaxRate::all();
	}

	public function getPaged($page = 1, $numPerPage = null)
	{
		\DB::getPaginator()->setCurrentPage($page);
		return TaxRate::orderBy('name')->paginate($numPerPage ?: \Config::get('defaultNumPerPage'));
	}

	public function find($id)
	{
		return TaxRate::find($id);
	}

	public function lists()
	{
		return array_merge(array('0' => trans('fi.none')), TaxRate::lists('name', 'id'));
	}
	
	public function create($name, $percent)
	{
		TaxRate::create(
			array(
				'name'    => $name,
				'percent' => $percent
			)
		);
	}
	
	public function update($id, $name, $percent)
	{
		$taxRate = TaxRate::find($id);

		$taxRate->fill(
			array(
				'name'    => $name,
				'percent' => $percent
			)
		);

		$taxRate->save();
	}
	
	public function delete($id)
	{
		TaxRate::destroy($id);
	}
	
}