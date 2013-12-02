<?php

use FI\Storage\Eloquent\Models\InvoiceGroup;

class InvoiceGroupTableSeeder extends Seeder {
	
	public function run()
	{
		InvoiceGroup::create(
			array(
				'id'           => 1,
				'name'         => trans('fi.invoice_default'),
				'prefix'       => 'INV',
				'next_id'      => 1,
				'left_pad'     => 0,
				'prefix_year'  => 0,
				'prefix_month' => 0
			)
		);

		InvoiceGroup::create(
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
	}

}
