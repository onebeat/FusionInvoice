<?php namespace FI\Storage\Eloquent\Repositories;

use \FI\Storage\Eloquent\Models\PaymentMethod;

class PaymentMethodRepository implements \FI\Storage\Interfaces\PaymentMethodRepositoryInterface {
	
	public function all()
	{
		return PaymentMethod::all();
	}

	public function getPaged($page = 1, $numPerPage = 15)
	{
		\DB::getPaginator()->setCurrentPage($page);
		return PaymentMethod::paginate($numPerPage);
	}

	public function find($id)
	{
		return PaymentMethod::find($id);
	}
	
	public function create($input)
	{
		PaymentMethod::create($input);
	}
	
	public function update($input, $id)
	{
		$paymentMethod = PaymentMethod::find($id);
		$paymentMethod->fill($input);
		$paymentMethod->save();
	}
	
	public function delete($id)
	{
		PaymentMethod::destroy($id);
	}
	
}