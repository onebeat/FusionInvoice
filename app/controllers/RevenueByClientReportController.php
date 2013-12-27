<?php

use FI\Classes\CurrencyFormatter;
use FI\Classes\Date;

class RevenueByClientReportController extends BaseController {

	protected $payment;

	public function __construct($payment)
	{
		$this->payment = $payment;
	}
	
	public function index()
	{
		$years = range(date('Y') - 10, date('Y'));
		$years = array_combine($years, $years);

		return View::make('reports.revenue_by_client')
		->with('years', $years);
	}

	public function ajaxRunReport()
	{
		$results = array();
		$months  = array();

		for ($month = 1; $month <= 12; $month++)
		{
			$months[$month] = Date::getMonthShortName($month);
		}

		$payments = $this->payment->getByYear(Input::get('year'));

		foreach ($payments as $payment)
		{
			if (isset($results[$payment->invoice->client->name]['months'][date('n', strtotime($payment->paid_at))]))
			{
				$results[$payment->invoice->client->name]['months'][date('n', strtotime($payment->paid_at))] += $payment->amount;
			}
			else
			{
				$results[$payment->invoice->client->name]['months'][date('n', strtotime($payment->paid_at))] = $payment->amount;
			}
		}

		foreach ($results as $client => $result)
		{
			$results[$client]['total'] = 0;

			foreach (range(1, 12) as $month)
			{
				if (!isset($results[$client]['months'][$month]))
				{
					$results[$client]['months'][$month] = CurrencyFormatter::format(0);
				}
				else
				{	
					$results[$client]['total'] += $results[$client]['months'][$month];
					$results[$client]['months'][$month] = CurrencyFormatter::format($results[$client]['months'][$month]);
				}
			}
			$results[$client]['total'] = CurrencyFormatter::format($results[$client]['total']);
		}

		return View::make('reports._revenue_by_client')
		->with('months', $months)
		->with('results', $results);
	}

}