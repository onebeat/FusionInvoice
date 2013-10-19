<?php

class SettingTableSeeder extends Seeder {
	
	public function run()
	{
		$settings = [
			[
				'setting_key' => 'language',
				'setting_value' => 'english'
			]
		];

		DB::table('fi_settings')->insert($settings);
	}

}