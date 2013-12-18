<?php

use Illuminate\Database\Migrations\Migration;

class CustomFields extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('custom_fields', function($table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->string('table_name');
			$table->string('column_name');
			$table->string('field_label');
			$table->string('field_type');
			$table->text('field_meta');

			$table->index('table_name');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('custom_fields');
	}

}