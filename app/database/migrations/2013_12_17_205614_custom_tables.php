<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Database\Migrations\Migration;

class CustomTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('clients_custom', function($table)
		{
			$table->integer('client_id');
			$table->timestamps();

			$table->primary('client_id');
		});

		Schema::create('invoices_custom', function($table)
		{
			$table->integer('invoice_id');
			$table->timestamps();

			$table->primary('invoice_id');
		});

		Schema::create('quotes_custom', function($table)
		{
			$table->integer('quote_id');
			$table->timestamps();

			$table->primary('quote_id');
		});

		Schema::create('payments_custom', function($table)
		{
			$table->integer('payment_id');
			$table->timestamps();

			$table->primary('payment_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('clients_custom');
		Schema::drop('invoices_custom');
		Schema::drop('quotes_custom');
		Schema::drop('payments_custom');
	}

}