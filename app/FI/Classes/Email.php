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

class Email {
	
	static function listSendMethods()
	{
		return array(
			''         => '',
			'smtp'     => trans('fi.email_send_method_smtp'),
			'mail'     => trans('fi.email_send_method_phpmail'),
			'sendmail' => trans('fi.email_send_method_sendmail')
		);
	}

	static function listEncryptions()
	{
		return array(
			'0'   => trans('fi.none'), 
			'ssl' => 'SSL', 
			'tls' => 'TLS'
		);
	}

}