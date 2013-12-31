<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class SettingTableSeeder extends Seeder {
	
	/**
	 * Insert some default settings
	 * @return void
	 */
	public function run()
	{
		$settingRepo = App::make('SettingRepository');
		
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
				'setting_key'   => 'invoiceTemplate',
				'setting_value' => 'default.blade.php'
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
				'setting_key'   => 'quoteTemplate',
				'setting_value' => 'default.blade.php'
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
				'setting_key'   => 'mailDriver',
				'setting_value' => ''
			),
			array(
				'setting_key'   => 'mailHost',
				'setting_value' => ''
			),
			array(
				'setting_key'   => 'mailPort',
				'setting_value' => ''
			),
			array(
				'setting_key'   => 'mailUsername',
				'setting_value' => ''
			),
			array(
				'setting_key'   => 'mailPassword',
				'setting_value' => ''
			),
			array(
				'setting_key'   => 'mailEncryption',
				'setting_value' => '0'
			),
			array(
				'setting_key'   => 'mailSendmail',
				'setting_value' => ''
			)
		);

		foreach ($settings as $setting)
		{
			$settingRepo->save($setting['setting_key'], $setting['setting_value']);
		}
	}

}