<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class InvoiceGroupTableSeeder extends Seeder {
	
	/**
	 * Create the default invoice groups
	 * @return void
	 */
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
