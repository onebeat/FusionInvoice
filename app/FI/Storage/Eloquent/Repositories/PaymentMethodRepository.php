<?php namespace FI\Storage\Eloquent\Repositories;

use FI\Storage\Eloquent\Models\PaymentMethod;

class PaymentMethodRepository implements \FI\Storage\Interfaces\PaymentMethodRepositoryInterface {
	
	/**
	 * Get a list of all records
	 * @return PaymentMethod
	 */
	public function all()
	{
		return PaymentMethod::all();
	}

	/**
	 * Get a paged list of records
	 * @param  int $page
	 * @param  int  $numPerPage
	 * @return PaymentMethod
	 */
	public function getPaged($page = 1, $numPerPage = null)
	{
		\DB::getPaginator()->setCurrentPage($page);
		return PaymentMethod::paginate($numPerPage ?: \Config::get('defaultNumPerPage'));
	}

	/**
	 * Get a single record
	 * @param  int $id
	 * @return PaymentMethod
	 */
	public function find($id)
	{
		return PaymentMethod::find($id);
	}

	/**
	 * Get a list of records formatted for dropdown
	 * @return PaymentMethod
	 */
	public function lists()
	{
		return PaymentMethod::lists('name', 'id');
	}
	
	/**
	 * Create a record
	 * @param  string $name
	 * @return void
	 */
	public function create($name)
	{
		PaymentMethod::create(
			array(
				'name' => $name
			)
		);
	}
	
	/**
	 * Update a record
	 * @param  int $id
	 * @param  string $name
	 * @return void
	 */
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
	
	/**
	 * Delete a record
	 * @param  int $id
	 * @return void
	 */
	public function delete($id)
	{
		PaymentMethod::destroy($id);
	}
	
}