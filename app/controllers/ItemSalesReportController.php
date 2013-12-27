<?php

use FI\Classes\CurrencyFormatter;
use FI\Classes\Date;
use FI\Classes\NumberFormatter;

class ItemSalesReportController extends BaseController {

	protected $invoiceItem;

	public function __construct($invoiceItem)
	{
		$this->invoiceItem = $invoiceItem;
	}
	
	public function index()
	{
		return View::make('reports.item_sales');
	}

	public function ajaxRunReport()
	{
		$results = array();

		$items = $this->invoiceItem->getByDateRange(Date::unformat(Input::get('from_date')), Date::unformat(Input::get('to_date')));

		foreach ($items as $item)
		{
			$results[$item->name]['items'][] = array(
				'client_name'    => $item->invoice->client->name,
				'invoice_number' => $item->invoice->number,
				'date'           => $item->invoice->formatted_created_at,
				'price'          => $item->formatted_price,
				'quantity'       => $item->formatted_quantity,
				'total'          => $item->amount->formatted_total
			);

			if (isset($results[$item->name]['totals']))
			{
				$results[$item->name]['totals']['quantity'] += $item->quantity;
				$results[$item->name]['totals']['total']    += $item->amount->total;
			}
			else
			{
				$results[$item->name]['totals']['quantity'] = $item->quantity;
				$results[$item->name]['totals']['total']    = $item->amount->total;
			}
		}

		foreach ($results as $key => $result)
		{
			$results[$key]['totals']['quantity'] = NumberFormatter::format($results[$key]['totals']['quantity']);
			$results[$key]['totals']['total']    = CurrencyFormatter::format($results[$key]['totals']['total']);
		}

		return View::make('reports._item_sales')
		->with('results', $results);
	}

}