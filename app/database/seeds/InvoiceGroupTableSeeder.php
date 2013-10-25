<?php

class InvoiceGroupTableSeeder extends Seeder {
	
	public function run()
	{
		$settings = array(
			array(
				'id'           => 1,
				'name'         => trans('fi.invoice_default'),
				'prefix'       => 'INV',
				'next_id'      => 1,
				'left_pad'     => 0,
				'prefix_year'  => 0,
				'prefix_month' => 0
			),
			array(
				'id'           => 2,
				'name'         => trans('fi.quote_default'),
				'prefix'       => 'QUO',
				'next_id'      => 1,
				'left_pad'     => 0,
				'prefix_year'  => 0,
				'prefix_month' => 0
			)
		);

		DB::table('invoice_groups')->insert($settings);
	}

}