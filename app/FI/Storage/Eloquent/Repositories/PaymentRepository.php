<?php namespace FI\Storage\Eloquent\Repositories;

use FI\Storage\Eloquent\Models\Payment;

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
	 * Get a list of records by date range
	 * @param  string $from
	 * @param  string $to
	 * @return Payment
	 */
	public function getByDateRange($from, $to)
	{
		return Payment::byDateRange($from, $to)->orderBy('paid_at')->get();
	}

	/**
	 * Get a list of records by year
	 * @param  int $year
	 * @return Payment
	 */
	public function getByYear($year)
	{
		return Payment::byYear($year)->get();
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
	}
	
}