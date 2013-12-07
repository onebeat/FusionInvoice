<?php namespace FI\Storage\Eloquent\Repositories;

use FI\Storage\Eloquent\Models\Payment;
use FI\Classes\NumberFormatter;
use FI\Classes\Date;

class PaymentRepository implements \FI\Storage\Interfaces\PaymentRepositoryInterface {
	
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
		return Payment::find($id);
	}

	/**
	 * Create a record
	 * @param  int $invoiceId
	 * @param  float $amount
	 * @param  string $paidAt
	 * @param  int $paymentMethodId
	 * @param  string $note
	 * @return void
	 */
	public function create($invoiceId, $amount, $paidAt, $paymentMethodId, $note)
	{
		Payment::create(
			array(
				'invoice_id'        => $invoiceId,
				'payment_method_id' => $paymentMethodId,
				'paid_at'           => Date::unformat($paidAt),
				'amount'            => NumberFormatter::unformat($amount),
				'note'              => $note
			)
		);
	}
	
	/**
	 * Update a record
	 * @param  int $id
	 * @param  float $amount
	 * @param  string $paidAt
	 * @param  int $paymentMethodId
	 * @param  string $note
	 * @return void
	 */
	public function update($id, $amount, $paidAt, $paymentMethodId, $note)
	{
		$payment = Payment::find($id);

		$payment->fill(
			array(
				'payment_method_id' => $paymentMethodId,
				'paid_at'           => Date::unformat($paidAt),
				'amount'            => NumberFormatter::unformat($amount),
				'note'              => $note
			)
		);

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
	}
	
}