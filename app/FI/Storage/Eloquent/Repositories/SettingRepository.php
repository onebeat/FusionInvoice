<?php namespace FI\Storage\Eloquent\Repositories;

use \FI\Storage\Eloquent\Models\Setting;

class SettingRepository implements \FI\Storage\Interfaces\SettingRepositoryInterface {

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
	 * @param  array $input 
	 * @return void
	 */
	public function save($input)
	{
		foreach ($input as $key=>$value)
		{
			if (substr($key, 0, 8) == 'setting_')
			{
				$key = substr($key, 8);

				if ($setting = Setting::where('setting_key', $key)->first())
				{
					$setting->setting_key = $key;
					$setting->setting_value = $value;
					$setting->save();
				}
				else
				{
					Setting::create(array('setting_key' => $key, 'setting_value' => $value));
				}
			}
		}
	}

}