<?php

class InvoiceGroupTableSeeder extends Seeder {
	
	public function run()
	{
		$invoiceGroup = App::make('FI\Storage\Interfaces\InvoiceGroupRepositoryInterface');

		$invoiceGroup->create(trans('fi.invoice_default'), 1, 0, 'INV', 0, 0);

		$invoiceGroup->create(trans('fi.quote_default'), 1, 0, 'QUO', 0, 0);
	}

}
