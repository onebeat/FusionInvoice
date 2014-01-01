<?php

Route::group(array('before' => 'auth'), function()
{
	Route::get('reports/item_sales', array('uses' => 'ItemSalesReportController@index', 'as' => 'reports.itemSales'));
	Route::post('reports/item_sales', array('uses' => 'ItemSalesReportController@ajaxRunReport', 'as' => 'reports.itemSales.ajax.run'));
	Route::get('reports/payments_collected', array('uses' => 'PaymentsCollectedReportController@index', 'as' => 'reports.paymentsCollected'));
	Route::post('reports/payments_collected', array('uses' => 'PaymentsCollectedReportController@ajaxRunReport', 'as' => 'reports.paymentsCollected.ajax.run'));
	Route::get('reports/revenue_by_client', array('uses' => 'RevenueByClientReportController@index', 'as' => 'reports.revenueByClient'));
	Route::post('reports/revenue_by_client', array('uses' => 'RevenueByClientReportController@ajaxRunReport', 'as' => 'reports.revenueByClient.ajax.run'));
	Route::get('reports/tax_summary', array('uses' => 'TaxSummaryReportController@index', 'as' => 'reports.taxSummary'));
	Route::post('reports/tax_summary', array('uses' => 'TaxSummaryReportController@ajaxRunReport', 'as' => 'reports.taxSummary.ajax.run'));
});