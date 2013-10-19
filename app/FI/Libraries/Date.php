<?php namespace FI\Libraries;

class Date {
	
	/**
	 * Returns an array of date format options
	 * @return array
	 */
	static function formats()
	{
		return [
			'm/d/Y' => [
				'setting'    => 'm/d/Y',
				'datepicker' => 'mm/dd/yyyy'
			],
			'm-d-Y' => [
				'setting'    => 'm-d-Y',
				'datepicker' => 'mm-dd-yyyy'
			],
			'm.d.Y' => [
				'setting'    => 'm.d.Y',
				'datepicker' => 'mm.dd.yyyy'
			],
			'Y/m/d' => [
				'setting'    => 'Y/m/d',
				'datepicker' => 'yyyy/mm/dd'
			],
			'Y-m-d' => [
				'setting'    => 'Y-m-d',
				'datepicker' => 'yyyy-mm-dd'
			],
			'Y.m.d' => [
				'setting'    => 'Y.m.d',
				'datepicker' => 'yyyy.mm.dd'
			],
			'd/m/Y' => [
				'setting'    => 'd/m/Y',
				'datepicker' => 'dd/mm/yyyy'
			],
			'd-m-Y' => [
				'setting'    => 'd-m-Y',
				'datepicker' => 'dd-mm-yyyy'
			],
			'd-M-Y' => [
				'setting'    => 'd-M-Y',
				'datepicker' => 'dd-M-yyyy'
			],
			'd.m.Y' => [
				'setting'    => 'd.m.Y',
				'datepicker' => 'dd.mm.yyyy'
			]
		];
	}

	/**
	 * Returns a flattened version of the format() method array to display 
	 * as dropdown options
	 * @return array
	 */
	static function dropdownArray()
	{
		$formats = self::formats();

		$return = array();

		foreach ($formats as $format)
		{
			$return[$format['setting']] = $format['setting'];
		}

		return $return;
	}

// 	static function date_from_mysql($date)
// 	{
// 		if ($date <> '0000-00-00')
// 		{
// 			if (!$_POST or $ignore_post_check)
// 			{
// 				$CI = & get_instance();

// 				$date = DateTime::createFromFormat('Y-m-d', $date);
// 				return $date->format($CI->mdl_settings->setting('date_format'));
// 			}
// 			return $date;
// 		}
// 		return '';
// 	}

// 	static function date_from_timestamp($timestamp)
// 	{
// 		$CI = & get_instance();

// 		$date = new DateTime();
// 		$date->setTimestamp($timestamp);
// 		return $date->format($CI->mdl_settings->setting('date_format'));
// 	}

// 	static function date_to_mysql($date)
// 	{
// 		$CI = & get_instance();

// 		$date = DateTime::createFromFormat($CI->mdl_settings->setting('date_format'), $date);
// 		return $date->format('Y-m-d');
// 	}

// 	static function date_format_setting()
// 	{
// 		$CI = & get_instance();

// 		$date_format = $CI->mdl_settings->setting('date_format');

// 		$date_formats = date_formats();

// 		return $date_formats[$date_format]['setting'];
// 	}

// 	static function date_format_datepicker()
// 	{
// 		$CI = & get_instance();

// 		$date_format = $CI->mdl_settings->setting('date_format');

// 		$date_formats = date_formats();

// 		return $date_formats[$date_format]['datepicker'];
// 	}

// /**
//  * Adds interval to user formatted date and returns user formatted date
//  * To be used when date is being output back to user
//  * @param $date - user formatted date
//  * @param $increment - interval (1D, 2M, 1Y, etc)
//  * @return user formatted date
//  */
// static function increment_user_date($date, $increment)
// {
// 	$CI = & get_instance();

// 	$mysql_date = date_to_mysql($date);

// 	$new_date = new DateTime($mysql_date);
// 	$new_date->add(new DateInterval('P' . $increment));

// 	return $new_date->format($CI->mdl_settings->setting('date_format'));
// }

// /**
//  * Adds interval to yyyy-mm-dd date and returns in same format
//  * @param $date
//  * @param $increment
//  * @return date
//  */
// static function increment_date($date, $increment)
// {
// 	$new_date = new DateTime($date);
// 	$new_date->add(new DateInterval('P' . $increment));
// 	return $new_date->format('Y-m-d');
// }

}