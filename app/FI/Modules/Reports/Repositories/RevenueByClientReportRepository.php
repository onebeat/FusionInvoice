<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Reports\Repositories;

use FI\Classes\CurrencyFormatter;
use FI\Modules\Payments\Models\Payment;

class RevenueByClientReportRepository {
	
	/**
	 * Get the report results
	 * @param  int $year
	 * @return array
	 */
	public function getResults($year)
	{
		$results = array();

		$payments = Payment::byYear($year)->get();

		foreach ($payments as $payment)
		{
			if (isset($results[$payment->invoice->client->name]['months'][date('n', strtotime($payment->paid_at))]))
			{
				$results[$payment->invoice->client->name]['months'][date('n', strtotime($payment->paid_at))] += $payment->amount;
			}
			else
			{
				$results[$payment->invoice->client->name]['months'][date('n', strtotime($payment->paid_at))] = $payment->amount;
			}
		}

		foreach ($results as $client => $result)
		{
			$results[$client]['total'] = 0;

			foreach (range(1, 12) as $month)
			{
				if (!isset($results[$client]['months'][$month]))
				{
					$results[$client]['months'][$month] = CurrencyFormatter::format(0);
				}
				else
				{	
					$results[$client]['total'] += $results[$client]['months'][$month];
					$results[$client]['months'][$month] = CurrencyFormatter::format($results[$client]['months'][$month]);
				}
			}
			$results[$client]['total'] = CurrencyFormatter::format($results[$client]['total']);
		}

		return $results;
	}
	
}