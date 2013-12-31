<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Storage\Eloquent\Repositories;

use FI\Classes\CurrencyFormatter;
use FI\Classes\NumberFormatter;
use FI\Storage\Eloquent\Models\InvoiceItem;
use FI\Storage\Eloquent\Models\InvoiceTaxRate;

class TaxSummaryReportRepository {
	
	public function getResults($fromDate, $toDate)
	{
		$results = array();

		$invoiceItems = InvoiceItem::byDateRange($fromDate, $toDate)->where('tax_rate_id', '<>', 0)->get();

		foreach ($invoiceItems as $invoiceItem)
		{
			$percent = NumberFormatter::format($invoiceItem->taxRate->percent);

			if (isset($results[$invoiceItem->taxRate->name . ' (' . $percent . ')']))
			{
				$results[$invoiceItem->taxRate->name . ' (' . $percent . '%)']['taxable_amount'] += $invoiceItem->amount->subtotal;
				$results[$invoiceItem->taxRate->name . ' (' . $percent . '%)']['taxes'] += $invoiceItem->amount->tax_total;
			}
			else
			{
				$results[$invoiceItem->taxRate->name . ' (' . $percent . '%)']['taxable_amount'] = $invoiceItem->amount->subtotal;
				$results[$invoiceItem->taxRate->name . ' (' . $percent . '%)']['taxes'] = $invoiceItem->amount->tax_total;
			}
		}

		$invoiceTaxRates = InvoiceTaxRate::byInvoiceDateRange($fromDate, $toDate)->get();

		foreach ($invoiceTaxRates as $invoiceTaxRate)
		{
			$percent = NumberFormatter::format($invoiceTaxRate->taxRate->percent);

			if (isset($results[$invoiceTaxRate->taxRate->name . ' (' . $percent . ')']))
			{
				if ($invoiceTaxRate->include_item_tax)
				{
					$results[$invoiceTaxRate->taxRate->name . ' (' . $percent . '%)']['taxable_amount'] += $invoiceTaxRate->invoice->amount->total;
				}
				else
				{
					$results[$invoiceTaxRate->taxRate->name . ' (' . $percent . '%)']['taxable_amount'] += $invoiceTaxRate->invoice->amount->item_subtotal;
				}
				
				$results[$invoiceTaxRate->taxRate->name . ' (' . $percent . '%)']['taxes'] += $invoiceTaxRate->tax_total;
			}
			else
			{
				if ($invoiceTaxRate->include_item_tax)
				{
					$results[$invoiceTaxRate->taxRate->name . ' (' . $percent . '%)']['taxable_amount'] = $invoiceTaxRate->invoice->amount->total;
				}
				else
				{
					$results[$invoiceTaxRate->taxRate->name . ' (' . $percent . '%)']['taxable_amount'] = $invoiceTaxRate->invoice->amount->item_subtotal;
				}

				$results[$invoiceTaxRate->taxRate->name . ' (' . $percent . '%)']['taxes'] = $invoiceTaxRate->tax_total;
			}
		}

		foreach ($results as $key=>$result)
		{
			$results[$key]['taxable_amount'] = CurrencyFormatter::format($result['taxable_amount']);
			$results[$key]['taxes'] = CurrencyFormatter::format($result['taxes']);
		}

		return $results;
	}

}