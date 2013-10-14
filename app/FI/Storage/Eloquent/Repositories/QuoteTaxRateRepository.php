<?php namespace FI\Storage\Eloquent\Repositories;

use \FI\Storage\Eloquent\Models\QuoteTaxRate;

class QuoteTaxRateRepository implements \FI\Storage\Interfaces\QuoteTaxRateRepositoryInterface {

	public function find($id)
	{
		return QuoteTaxRate::find($id);
	}
	
	public function create($input)
	{
		QuoteTaxRate::create($input);
	}
	
	public function update($input, $id)
	{
		$quoteTaxRate = QuoteTaxRate::find($id);
		$quoteTaxRate->fill($input);
		$quoteTaxRate->save();
	}
	
	public function delete($id)
	{
		QuoteTaxRate::destroy($id);
	}
	
}