<?php

class SettingTableSeeder extends Seeder {
	
	public function run()
	{
		$settings = array(
			array(
				'setting_key'   => 'language',
				'setting_value' => 'en'
			),
			array(
				'setting_key'   => 'dateFormat',
				'setting_value' => 'm/d/Y'
			),
			array(
				'setting_key'   => 'currencySymbol',
				'setting_value' => '$'
			),
			array(
				'setting_key'   => 'currencySymbolPlacement',
				'setting_value' => 'before'
			),
			array(
				'setting_key'   => 'thousandsSeparator',
				'setting_value' => ','
			),
			array(
				'setting_key'   => 'decimalPoint',
				'setting_value' => '.'
			),
			array(
				'setting_key'   => 'taxRateDecimalPlaces',
				'setting_value' => '2'
			),
			array(
				'setting_key'   => 'invoicePdfTemplate',
				'setting_value' => 'default.php'
			),
			array(
				'setting_key'   => 'invoicePdfTemplatePaid',
				'setting_value' => 'default.php'
			),
			array(
				'setting_key'   => 'invoicePdfTemplateOverdue',
				'setting_value' => 'default.php'
			),
			array(
				'setting_key'   => 'invoicePublicTemplate',
				'setting_value' => 'default.php'
			),
			array(
				'setting_key'   => 'invoicesDueAfter',
				'setting_value' => '30'
			),
			array(
				'setting_key'   => 'invoiceGroup',
				'setting_value' => '1'
			),
			array(
				'setting_key'   => 'quotePdfTemplate',
				'setting_value' => 'default.php'
			),
			array(
				'setting_key'   => 'quotePublicTemplate',
				'setting_value' => 'default.php'
			),
			array(
				'setting_key'   => 'quotesExpireAfter',
				'setting_value' => '15'
			),
			array(
				'setting_key'   => 'quoteGroup',
				'setting_value' => '2'
			),
			array(
				'setting_key'   => 'invoiceEmailTemplate',
				'setting_value' => '0'
			),
			array(
				'setting_key'   => 'invoiceEmailTemplatePaid',
				'setting_value' => '0'
			),
			array(
				'setting_key'   => 'invoiceEmailTemplateOverdue',
				'setting_value' => '0'
			),
			array(
				'setting_key'   => 'invoiceTerms',
				'setting_value' => ''
			),
			array(
				'setting_key'   => 'automaticEmailOnRecur',
				'setting_value' => '0'
			),
			array(
				'setting_key'   => 'markInvoicesSentPdf',
				'setting_value' => '0'
			),
			array(
				'setting_key'   => 'quoteEmailTemplate',
				'setting_value' => '0'
			),
			array(
				'setting_key'   => 'markQuotesSentPdf',
				'setting_value' => '0'
			),
			array(
				'setting_key'   => 'invoiceTaxRate',
				'setting_value' => '0'
			),
			array(
				'setting_key'   => 'includeItemTax',
				'setting_value' => '0'
			),
			array(
				'setting_key'   => 'itemTaxRate',
				'setting_value' => '0'
			),
			array(
				'setting_key'   => 'emailSendMethod',
				'setting_value' => ''
			),
			array(
				'setting_key'   => 'emailSmtpHostAddress',
				'setting_value' => ''
			),
			array(
				'setting_key'   => 'emailSmtpHostPort',
				'setting_value' => ''
			),
			array(
				'setting_key'   => 'emailSmtpUsername',
				'setting_value' => ''
			),
			array(
				'setting_key'   => 'emailSmtpPassword',
				'setting_value' => ''
			),
			array(
				'setting_key'   => 'emailSmtpEncryption',
				'setting_value' => '0'
			),
			array(
				'setting_key'   => 'emailSendmailPath',
				'setting_value' => ''
			)
		);

		DB::table('settings')->insert($settings);
	}

}