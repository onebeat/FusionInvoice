<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use FI\Classes\Date;

class TaxSummaryReportController extends BaseController {

	/**
	 * Tax summary report repository
	 * @var TaxSummaryReportRepository
	 */
	protected $taxSummaryReport;

	/**
	 * Dependency injection
	 * @param TaxSummaryReportRepository $taxSummaryReport
	 */
	public function __construct($taxSummaryReport)
	{
		$this->taxSummaryReport = $taxSummaryReport;
	}
	
	/**
	 * Display the report interface
	 * @return View
	 */
	public function index()
	{
		return View::make('reports.tax_summary');
	}

	/**
	 * Run the report and display the results
	 * @return View
	 */
	public function ajaxRunReport()
	{
		return View::make('reports._tax_summary')
		->with('results', $this->taxSummaryReport->getResults(Date::unformat(Input::get('from_date')), Date::unformat(Input::get('to_date'))));
	}

}