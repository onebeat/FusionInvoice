<?php namespace FI\Storage\Eloquent\Repositories;

use \FI\Storage\Eloquent\Models\PaymentMethod;

class PaymentMethodRepository implements \FI\Storage\Interfaces\PaymentMethodRepositoryInterface {
	
	public function all()
	{
		return PaymentMethod::all();
	}

	public function getPaged($page = 1, $numPerPage = null)
	{
		\DB::getPaginator()->setCurrentPage($page);
		return PaymentMethod::paginate($numPerPage ?: \Config::get('defaultNumPerPage'));
	}

	public function find($id)
	{
		return PaymentMethod::find($id);
	}

	public function lists()
	{
		return PaymentMethod::lists('name', 'id');
	}
	
	public function create($name)
	{
		PaymentMethod::create(
			array(
				'name' => $name
			)
		);
	}
	
	public function update($id, $name)
	{
		$paymentMethod = PaymentMethod::find($id);

		$paymentMethod->fill(
			array(
				'name' => $name
			)
		);

		$paymentMethod->save();
	}
	
	public function delete($id)
	{
		PaymentMethod::destroy($id);
	}
	
}