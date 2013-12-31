<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use FI\Classes\Date;
use FI\Classes\Email;
use FI\Classes\Languages;
use FI\Templates\InvoiceTemplates;
use FI\Templates\QuoteTemplates;

class SettingController extends BaseController {

	/**
	 * Setting repository
	 * @var SettingRepository
	 */
	protected $settings;

	/**
	 * Invoice group repository
	 * @var InvoiceGroupRepository
	 */
	protected $invoiceGroups;

	/**
	 * Tax rate repository
	 * @var TaxRateRepository
	 */
	protected $taxRates;

	/**
	 * Dependency injection
	 * @param SettingRepository $settings
	 * @param InvoiceGroupRepository $invoiceGroups
	 * @param TaxRateRepository $taxRates
	 */
	public function __construct($settings, $invoiceGroups, $taxRates)
	{
		$this->settings       = $settings;
		$this->invoiceGroups  = $invoiceGroups;
		$this->taxRates       = $taxRates;
	}
	
	/**
	 * Displays the settings
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		return View::make('settings.index')
		->with(array(
			'languages'                => Languages::listLanguages(),
			'currencySymbolPlacements' => array('before' => trans('fi.before_amount'), 'after' => trans('fi.after_amount')),
			'taxRateDecimalPlaces'     => array('2' => '2', '3' => '3'),
			'dateFormats'              => Date::dropdownArray(),
			'invoiceTemplates'         => InvoiceTemplates::lists(),
			'quoteTemplates'           => QuoteTemplates::lists(),
			'invoiceGroups'            => $this->invoiceGroups->lists(),
			'taxRates'                 => $this->taxRates->lists(),
			'emailSendMethods'         => Email::listSendMethods(),
			'emailEncryptions'         => Email::listEncryptions(),
			'yesNoArray'               => array('0' => trans('fi.no'), '1' => trans('fi.yes')),
			'timezones'                => array_combine(timezone_identifiers_list(), timezone_identifiers_list())
		));
	}

	/**
	 * Handle setting form submission
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update()
	{
		foreach (Input::all() as $key => $value)
		{
			if (substr($key, 0, 8) == 'setting_')
			{
				$skipSave = false;
				
				$key = substr($key, 8);

				if ($key == 'mailPassword' and $value)
				{
					$value = Crypt::encrypt($value);
				}
				elseif ($key == 'mailPassword' and !$value)
				{
					$skipSave = true;
				}

				if (!$skipSave)
				{
					$this->settings->save($key, $value);
				}
			}
		}

		if (Input::hasFile('invoice_logo'))
		{
			$ext = Input::file('invoice_logo')->getClientOriginalExtension();

			Input::file('invoice_logo')->move(Config::get('fi.logoUploadPath'), 'invoice_logo.' . $ext);

			$this->settings->save('invoiceLogo', 'invoice_logo.' . $ext);
		}

		return Redirect::route('settings.index')
		->with('alertSuccess', trans('fi.settings_successfully_saved'));
	}

}