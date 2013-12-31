<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Storage\Eloquent\Repositories;

use FI\Storage\Eloquent\Models\Setting;
use FI\Classes\Date;

class SettingRepository {

	/**
	 * Used during app start to place settings in Config
	 * @return void
	 */
	public function setAll()
	{
		$settings = Setting::all();
		
		foreach ($settings as $setting)
		{
			\Config::set('fi.' . $setting->setting_key, $setting->setting_value);
		}
	}

	/**
	 * Saves settings submitted by the setting form
	 * @param  string $key
	 * @param  string $value
	 * @return void
	 */
	public function save($key, $value)
	{
		if ($setting = Setting::where('setting_key', $key)->first())
		{
			$setting->setting_value = $value;
			$setting->save();
		}
		else
		{
			Setting::create(array('setting_key' => $key, 'setting_value' => $value));
		}
	}

}