<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Reports\Controllers;

use Input;
use View;

use FI\Classes\Date;

class RevenueByClientReportController extends \BaseController {

	/**
	 * Revenue by client report repository
	 * @var RevenueByClientReportRepository
	 */
	protected $revenueByClientReport;

	/**
	 * Dependency injection
	 * @param RevenueByClientReportRepository $revenueByClientReport
	 */
	public function __construct($revenueByClientReport)
	{
		$this->revenueByClientReport = $revenueByClientReport;
	}
	
	/**
	 * Display the report interface
	 * @return View
	 */
	public function index()
	{
		$years = range(date('Y') - 10, date('Y'));
		$years = array_combine($years, $years);

		return View::make('reports.revenue_by_client')
		->with('years', $years);
	}

	/**
	 * Run the report and display the results
	 * @return View
	 */
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