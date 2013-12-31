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

class ItemSalesReportController extends BaseController {

	protected $itemSalesReport;

	public function __construct($itemSalesReport)
	{
		$this->itemSalesReport = $itemSalesReport;
	}
	
	public function index()
	{
		return View::make('reports.item_sales');
	}

	public function ajaxRunReport()
	{
		return View::make('reports._item_sales')
		->with('results', $this->itemSalesReport->getResults(Date::unformat(Input::get('from_date')), Date::unformat(Input::get('to_date'))));
	}

}