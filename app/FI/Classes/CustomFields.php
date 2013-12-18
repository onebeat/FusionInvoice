<?php namespace FI\Classes;

class CustomFields {

	public static function tableNames()
	{
		return array(
			'clients'	 => trans('fi.clients'),
			'invoices'	 => trans('fi.invoices'),
			'quotes'	 => trans('fi.quotes'),
			'payments'	 => trans('fi.payments')
		);
	}

	public static function fieldtypes()
	{
		return array(
			'text'		 => trans('fi.text'),
			'dropdown'	 => trans('fi.dropdown'),
			'textarea'	 => trans('fi.textarea')
		);
	}

}