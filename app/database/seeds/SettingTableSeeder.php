<?php

class SettingTableSeeder extends Seeder {
	
	public function run()
	{
		$settings = array(
			array(
				'setting_key'   => 'language',
				'setting_value' => 'english'
			)
		);

		DB::table('settings')->insert($settings);
	}

}