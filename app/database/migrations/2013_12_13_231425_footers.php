<?php

use Illuminate\Database\Migrations\Migration;

class Footers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('invoices', function($table)
		{
			$table->text('footer')->nullable();
		});

		Schema::table('quotes', function($table)
		{
			$table->text('footer')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('invoices', function($table)
		{
			$table->dropColumn('footer');
		});

		Schema::table('quotes', function($table)
		{
			$table->dropColumn('footer');
		});
	}

}