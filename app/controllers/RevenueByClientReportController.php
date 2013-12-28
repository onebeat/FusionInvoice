<?php

use FI\Classes\Date;

class RevenueByClientReportController extends BaseController {

	protected $revenueByClientReport;

	public function __construct($revenueByClientReport)
	{
		$this->revenueByClientReport = $revenueByClientReport;
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
		$months  = array();

		foreach(range(1, 12) as $month)
		{
			$months[$month] = Date::getMonthShortName($month);
		}

		return View::make('reports._revenue_by_client')
		->with('months', $months)
		->with('results', $this->revenueByClientReport->getResults(Input::get('year')));
	}

}