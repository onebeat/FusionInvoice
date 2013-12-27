<?php

use FI\Classes\CurrencyFormatter;
use FI\Classes\Date;
use FI\Storage\Interfaces\PaymentRepositoryInterface;

class PaymentsCollectedReportController extends BaseController {

	protected $payment;

	public function __construct(PaymentRepositoryInterface $payment)
	{
		$this->payment = $payment;
	}
	
	public function index()
	{
		return View::make('reports.payments_collected');
	}

	public function ajaxRunReport()
	{
		$results = array('payments' => array(), 'total' => 0);

		$payments = $this->payment->getByDateRange(Date::unformat(Input::get('from_date')), Date::unformat(Input::get('to_date')));

		foreach ($payments as $payment)
		{
			$results['payments'][] = array(
				'client_name'    => $payment->invoice->client->name,
				'invoice_number' => $payment->invoice->number,
				'payment_method' => $payment->payment_method->name,
				'note'           => $payment->note,
				'date'           => $payment->formatted_paid_at,
				'amount'         => $payment->formatted_amount
			);

			$results['total'] += $payment->amount;
		}

		$results['total'] = CurrencyFormatter::format($results['total']);

		return View::make('reports._payments_collected')
		->with('results', $results);
	}

}