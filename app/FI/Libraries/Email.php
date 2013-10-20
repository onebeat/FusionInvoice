<?php namespace FI\Libraries;

class Email {
	
	static function listSendMethods()
	{
		return [
			''         => '',
			'smtp'     => trans('fi.email_send_method_smtp'),
			'mail'     => trans('fi.email_send_method_phpmail'),
			'sendmail' => trans('fi.email_send_method_sendmail')
		];
	}

	static function listEncryptions()
	{
		return [
			'0'    => trans('fi.none'), 
			'ssl ' => 'SSL', 
			'tls'  => 'TLS'
		];
	}

	/**
	 * emailSendMethod 		[smtp, mail, sendmail]
	 * emailSmtpHostAddress text
	 * emailSmtpHostPort 	text
	 * emailSmtpUsername	text
	 * emailSmtpPassword	text
	 * emailFromAddress 	text
	 * emailFromName 		text
	 * emailEncryption		[none, ssl, tls]
	 * emailSendmailPath	text, default '/usr/sbin/sendmail -bs'
	 */

}