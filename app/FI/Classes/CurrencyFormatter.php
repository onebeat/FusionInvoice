<?php namespace FI\Classes;

class CurrencyFormatter extends NumberFormatter {
	
	/**
	 * Formats currency according to FI config
	 * @param  decimal $amount
	 * @return decimal
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