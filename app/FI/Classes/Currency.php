<?php namespace FI\Classes;

class Currency {
	
	public static function format($amount)
	{
		if (\Config::get('fi.currencySymbolPlacement') == 'before')
		{
			return \Config::get('fi.currencySymbol') . $amount;
		}

		return $amount . \Config::get('fi.currencySymbol');
	}

}