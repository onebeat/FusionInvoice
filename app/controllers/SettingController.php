<?php

use FI\Classes\Languages;
use FI\Classes\Date;
use FI\Classes\Email;
use FI\Templates\QuoteTemplates;
use FI\Templates\InvoiceTemplates;

class SettingController extends BaseController {

	protected $settings;
	protected $emailTemplates;
	protected $invoiceGroups;
	protected $taxRates;

	public function __construct($settings, $emailTemplates, $invoiceGroups, $taxRates)
	{
		$this->settings       = $settings;
		$this->emailTemplates = $emailTemplates;
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
			'emailTemplates'           => $this->emailTemplates->lists(),
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
				$key = substr($key, 8);
				
				$this->settings->save($key, $value);
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