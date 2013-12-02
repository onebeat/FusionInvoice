<?php

use FI\Storage\Eloquent\Models\Setting;

class SettingTableSeeder extends Seeder {
	
	public function run()
	{
		Setting::create(
			array(
				'setting_key'   => 'language',
				'setting_value' => 'en'
			)
		);
		Setting::create(
			array(
				'setting_key'   => 'dateFormat',
				'setting_value' => 'm/d/Y'
			)
		);
		Setting::create(
			array(
				'setting_key'   => 'currencySymbol',
				'setting_value' => '$'
			)
		);
		Setting::create(
			array(
				'setting_key'   => 'currencySymbolPlacement',
				'setting_value' => 'before'
			)
		);
		Setting::create(
			array(
				'setting_key'   => 'thousandsSeparator',
				'setting_value' => ','
			)
		);
		Setting::create(
			array(
				'setting_key'   => 'decimalPoint',
				'setting_value' => '.'
			)
		);
		Setting::create(
			array(
				'setting_key'   => 'taxRateDecimalPlaces',
				'setting_value' => '2'
			)
		);
		Setting::create(
			array(
				'setting_key'   => 'invoiceTemplate',
				'setting_value' => 'default.blade.php'
			)
		);
		Setting::create(
			array(
				'setting_key'   => 'invoicesDueAfter',
				'setting_value' => '30'
			)
		);
		Setting::create(
			array(
				'setting_key'   => 'invoiceGroup',
				'setting_value' => '1'
			)
		);
		Setting::create(
			array(
				'setting_key'   => 'quoteTemplate',
				'setting_value' => 'default.blade.php'
			)
		);
		Setting::create(
			array(
				'setting_key'   => 'quotesExpireAfter',
				'setting_value' => '15'
			)
		);
		Setting::create(
			array(
				'setting_key'   => 'quoteGroup',
				'setting_value' => '2'
			)
		);
		Setting::create(
			array(
				'setting_key'   => 'invoiceEmailTemplate',
				'setting_value' => '0'
			)
		);
		Setting::create(
			array(
				'setting_key'   => 'invoiceEmailTemplatePaid',
				'setting_value' => '0'
			)
		);
		Setting::create(
			array(
				'setting_key'   => 'invoiceEmailTemplateOverdue',
				'setting_value' => '0'
			)
		);
		Setting::create(
			array(
				'setting_key'   => 'invoiceTerms',
				'setting_value' => ''
			)
		);
		Setting::create(
			array(
				'setting_key'   => 'automaticEmailOnRecur',
				'setting_value' => '0'
			)
		);
		Setting::create(
			array(
				'setting_key'   => 'markInvoicesSentPdf',
				'setting_value' => '0'
			)
		);
		Setting::create(
			array(
				'setting_key'   => 'quoteEmailTemplate',
				'setting_value' => '0'
			)
		);
		Setting::create(
			array(
				'setting_key'   => 'markQuotesSentPdf',
				'setting_value' => '0'
			)
		);
		Setting::create(
			array(
				'setting_key'   => 'invoiceTaxRate',
				'setting_value' => '0'
			)
		);
		Setting::create(
			array(
				'setting_key'   => 'includeItemTax',
				'setting_value' => '0'
			)
		);
		Setting::create(
			array(
				'setting_key'   => 'itemTaxRate',
				'setting_value' => '0'
			)
		);
		Setting::create(
			array(
				'setting_key'   => 'emailSendMethod',
				'setting_value' => ''
			)
		);
		Setting::create(
			array(
				'setting_key'   => 'emailSmtpHostAddress',
				'setting_value' => ''
			)
		);
		Setting::create(
			array(
				'setting_key'   => 'emailSmtpHostPort',
				'setting_value' => ''
			)
		);
		Setting::create(
			array(
				'setting_key'   => 'emailSmtpUsername',
				'setting_value' => ''
			)
		);
		Setting::create(
			array(
				'setting_key'   => 'emailSmtpPassword',
				'setting_value' => ''
			)
		);
		Setting::create(
			array(
				'setting_key'   => 'emailSmtpEncryption',
				'setting_value' => '0'
			)
		);
		Setting::create(
			array(
				'setting_key'   => 'emailSendmailPath',
				'setting_value' => ''
			)
		);
	}

}
