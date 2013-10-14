<?php namespace FI\Storage\Eloquent\Repositories;

use \FI\Storage\Eloquent\Models\Payment;

class PaymentRepository implements \FI\Storage\Interfaces\PaymentRepositoryInterface {
	
	public function all()
	{
		return Payment::all();
	}

	public function getPaged($page = 1, $numPerPage = 15)
	{
		\DB::getPaginator()->setCurrentPage($page);
		return Payment::paginate($numPerPage);
	}

	public function find($id)
	{
		return Payment::find($id);
	}
	
	public function create($input)
	{
		Payment::create($input);
	}
	
	public function update($input, $id)
	{
		$payment = Payment::find($id);
		$payment->fill($input);
		$payment->save();
	}
	
	public function delete($id)
	{
		Payment::destroy($id);
	}
	
}