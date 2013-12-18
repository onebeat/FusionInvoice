<?php

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
		Schema::drop('client_custom');
		Schema::drop('invoice_custom');
		Schema::drop('quote_custom');
		Schema::drop('payment_custom');
	}

}