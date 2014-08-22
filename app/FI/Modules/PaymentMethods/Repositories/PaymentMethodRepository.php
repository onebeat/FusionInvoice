<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\PaymentMethods\Repositories;

use FI\Modules\PaymentMethods\Models\PaymentMethod;

class PaymentMethodRepository {
	
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
	 * @param  array $input
	 * @return int
	 */
	public function create($input)
	{
		return PaymentMethod::create($input)->id;
	}
	
	/**
	 * Update a record
	 * @param  array $input
	 * @param  int $id
	 * @return void
	 */
	public function update($input, $id)
	{
		$paymentMethod = PaymentMethod::find($id);

		$paymentMethod->fill($input);

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