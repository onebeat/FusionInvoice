<?php

use FI\Classes\Date;

class TaxSummaryReportController extends BaseController {

	protected $taxSummaryReport;

	public function __construct($taxSummaryReport)
	{
		$this->taxSummaryReport = $taxSummaryReport;
	}
	
	public function index()
	{
		return View::make('reports.tax_summary');
	}

	public function ajaxRunReport()
	{
		return View::make('reports._tax_summary')
		->with('results', $this->taxSummaryReport->getResults(Date::unformat(Input::get('from_date')), Date::unformat(Input::get('to_date'))));
	}

}