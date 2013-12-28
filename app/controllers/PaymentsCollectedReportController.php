<?php

use FI\Classes\Date;

class PaymentsCollectedReportController extends BaseController {

	protected $paymentsCollectedReport;

	public function __construct($paymentsCollectedReport)
	{
		$this->paymentsCollectedReport = $paymentsCollectedReport;
	}
	
	public function index()
	{
		return View::make('reports.payments_collected');
	}

	public function ajaxRunReport()
	{
		return View::make('reports._payments_collected')
		->with('results', $this->paymentsCollectedReport->getResults(Date::unformat(Input::get('from_date')), Date::unformat(Input::get('to_date'))));
	}

}