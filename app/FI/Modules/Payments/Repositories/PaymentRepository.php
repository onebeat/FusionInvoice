<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Payments\Repositories;

use FI\Modules\Payments\Models\Payment;

class PaymentRepository {
	
	/**
	 * Get a list of all records
	 * @return Payment
	 */
	public function all()
	{
		return Payment::all();
	}

	/**
	 * Get a paged list of records
	 * @param  int $page
	 * @param  int  $numPerPage
	 * @return Payment
	 */
	public function getPaged($page = 1, $numPerPage = null)
	{
		\DB::getPaginator()->setCurrentPage($page);
		return Payment::paginate($numPerPage ?: \Config::get('defaultNumPerPage'));
	}

	/**
	 * Get the total amount paid by invoice id
	 * @param  int $invoiceId
	 * @return Payment
	 */
	public function getTotalPaidByInvoiceId($invoiceId)
	{
		return Payment::where('invoice_id', $invoiceId)->sum('amount');
	}

	/**
	 * Get a single record
	 * @param  int $id
	 * @return Payment
	 */
	public function find($id)
	{
		return Payment::with('custom')->find($id);
	}

	/**
	 * Get a list of records by invoice id
	 * @param  int $invoiceId
	 * @return Payment
	 */
	public function findByInvoiceId($invoiceId)
	{
		return Payment::where('invoice_id', '=', $invoiceId)->get();
	}

	/**
	 * Create a record
	 * @param  array $input
	 * @return int
	 */
	public function create($input)
	{
		return Payment::create($input)->id;
	}
	
	/**
	 * Update a record
	 * @param  array $input
	 * @param  int $id
	 * @return void
	 */
	public function update($input, $id)
	{
		$payment = Payment::find($id);

		$payment->fill($input);

		$payment->save();
	}
	
	/**
	 * Delete a record
	 * @param  int $id
	 * @return void
	 */
	public function delete($id)
	{
		Payment::destroy($id);

		\Event::fire('payment.deleted', array($id));
	}
	
}