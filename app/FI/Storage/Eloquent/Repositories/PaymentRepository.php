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
	
	public function delete($id)
	{
		Payment::destroy($id);
	}
	
}