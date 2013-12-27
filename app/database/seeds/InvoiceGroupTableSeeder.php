<?php

class InvoiceGroupTableSeeder extends Seeder {
	
	public function run()
	{
		$invoiceGroup = App::make('InvoiceGroupRepository');

		$invoiceGroup->create(
			array(
				'name'         => trans('fi.invoice_default'), 
				'next_id'      => 1, 
				'left_pad'     => 0, 
				'prefix'       => 'INV', 
				'prefix_year'  => 0, 
				'prefix_month' => 0
			)
		);

		$invoiceGroup->create(
			array(
				'name'         => trans('fi.quote_default'), 
				'next_id'      => 1, 
				'left_pad'     => 0, 
				'prefix'       => 'QUO', 
				'prefix_year'  => 0, 
				'prefix_month' => 0
			)
		);
	}

}
