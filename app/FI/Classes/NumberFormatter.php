<?php namespace FI\Classes;

class NumberFormatter {

	/**
	 * Formats a number according to FI config
	 * @param  float $number
	 * @return float
	 */
	public static function format($number)
	{
		return number_format($number, 2, \Config::get('fi.decimalPoint'), \Config::get('fi.thousandsSeparator'));
	}

	/**
	 * Unformats a formatted number
	 * @param  float $number
	 * @return float
	 */
	public static function unformat($number)
	{
		$number = str_replace(\Config::get('fi.decimalPoint'), 'D', $number);
		$number = str_replace(\Config::get('fi.thousandsSeparator'), '', $number);
		$number = str_replace('D', '.', $number);

		return $number;
	}

}