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