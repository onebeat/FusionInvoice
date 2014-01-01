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

class ItemSalesReportController extends \BaseController {

	/**
	 * Item sales report repository
	 * @var ItemSalesReportRepository
	 */
	protected $itemSalesReport;

	/**
	 * Dependency injection
	 * @param ItemSalesReportRepository $itemSalesReport
	 */
	public function __construct($itemSalesReport)
	{
		$this->itemSalesReport = $itemSalesReport;
	}
	
	/**
	 * Display the report interface
	 * @return View
	 */
	public function index()
	{
		return View::make('reports.item_sales');
	}

	/**
	 * Run the report and display the results
	 * @return View
	 */
	public function ajaxRunReport()
	{
		return View::make('reports._item_sales')
		->with('results', $this->itemSalesReport->getResults(Date::unformat(Input::get('from_date')), Date::unformat(Input::get('to_date'))));
	}

}