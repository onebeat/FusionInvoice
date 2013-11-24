<?php namespace FI\Storage\Eloquent\Repositories;

use \FI\Storage\Eloquent\Models\Payment;
use \FI\Classes\NumberFormatter;
use \FI\Classes\Date;

class PaymentRepository implements \FI\Storage\Interfaces\PaymentRepositoryInterface {
	
	public function all()
	{
		return Payment::all();
	}

	public function getPaged($page = 1, $numPerPage = null)
	{
		\DB::getPaginator()->setCurrentPage($page);
		return Payment::paginate($numPerPage ?: \Config::get('defaultNumPerPage'));
	}

	public function getTotalPaidByInvoiceId($invoiceId)
	{
		return Payment::where('invoice_id', $invoiceId)->sum('amount');
	}

	public function find($id)
	{
		return Payment::find($id);
	}
	
	public function create($input)
	{
		$record = array(
			'invoice_id'        => $input['invoice_id'],
			'payment_method_id' => $input['payment_method_id'],
			'paid_at'           => Date::unformat($input['paid_at']),
			'amount'            => NumberFormatter::unformat($input['amount']),
			'note'              => $input['note']
		);

		Payment::create($record);
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