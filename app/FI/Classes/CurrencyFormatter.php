<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Classes;

class CurrencyFormatter extends NumberFormatter {
	
	/**
	 * Formats currency according to FI config
	 * @param  float $amount
	 * @return string
	 */
	public static function format($amount)
	{
		$amount = parent::format($amount);
		
		if (\Config::get('fi.currencySymbolPlacement') == 'before')
		{
			return \Config::get('fi.currencySymbol') . $amount;
		}

		return $amount . \Config::get('fi.currencySymbol');
	}
}