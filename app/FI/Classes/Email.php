<?php namespace FI\Classes;

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
			'0'    => trans('fi.none'), 
			'ssl' => 'SSL', 
			'tls'  => 'TLS'
		);
	}

}