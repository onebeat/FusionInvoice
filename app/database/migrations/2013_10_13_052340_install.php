<?php

use Illuminate\Database\Migrations\Migration;

class Install extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('clients', function($table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->string('address_1')->nullable();
			$table->string('address_2')->nullable();
			$table->string('city')->nullable();
			$table->string('state')->nullable();
			$table->string('zip')->nullable();
			$table->string('country')->nullable();
			$table->string('phone')->nullable();
			$table->string('fax')->nullable();
			$table->string('mobile')->nullable();
			$table->string('email')->nullable();
			$table->string('web')->nullable();
			$table->boolean('active')->default(1);

			$table->index('name');
			$table->index('active');
		});

		Schema::create('client_notes', function($table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->integer('client_id');
			$table->text('note');

			$table->index('client_id');
		});

		Schema::create('email_templates', function($table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->string('subject');
			$table->text('body');

			$table->index('name');
		});

		Schema::create('invoices', function($table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->integer('user_id');
			$table->integer('client_id');
			$table->integer('invoice_group_id');
			$table->integer('invoice_status_id');
			$table->date('due_at');
			$table->string('number');
			$table->text('terms')->nullable();
			$table->string('url_key');

			$table->index('user_id');
			$table->index('client_id');
			$table->index('invoice_group_id');
			$table->index('invoice_status_id');
		});

		Schema::create('invoice_amounts', function($table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->integer('invoice_id');
			$table->decimal('item_subtotal', 10, 2)->default(0.00);
			$table->decimal('item_tax_total', 10, 2)->default(0.00);;
			$table->decimal('tax_total', 10, 2)->default(0.00);;
			$table->decimal('total', 10, 2)->default(0.00);;
			$table->decimal('paid', 10, 2)->default(0.00);;
			$table->decimal('balance', 10, 2)->default(0.00);;

			$table->index('invoice_id');
		});

		Schema::create('invoice_groups', function($table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->string('prefix');
			$table->integer('next_id')->default(1);
			$table->integer('left_pad')->default(0);
			$table->boolean('prefix_year')->default(0);
			$table->boolean('prefix_month')->default(0);
		});

		Schema::create('invoice_items', function($table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->integer('invoice_id');
			$table->integer('tax_rate_id');
			$table->string('name');
			$table->text('description');
			$table->decimal('quantity', 10, 2)->default(0.00);;
			$table->decimal('price', 10, 2)->default(0.00);;
			$table->integer('display_order')->default(0);

			$table->index('invoice_id');
			$table->index('tax_rate_id');
			$table->index('display_order');
		});

		Schema::create('invoice_item_amounts', function($table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->integer('item_id');
			$table->decimal('subtotal', 10, 2)->default(0.00);
			$table->decimal('tax_total', 10, 2)->default(0.00);
			$table->decimal('total', 10, 2)->default(0.00);

			$table->index('item_id');
		});

		Schema::create('invoice_tax_rates', function($table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->integer('invoice_id');
			$table->integer('tax_rate_id');
			$table->boolean('include_item_tax')->default(0);
			$table->decimal('tax_total', 10, 2)->default(0.00);

			$table->index('invoice_id');
			$table->index('tax_rate_id');
		});

		Schema::create('item_lookups', function($table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->text('description');
			$table->decimal('price', 10, 2)->default(0.00);
		});

		Schema::create('payments', function($table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->integer('invoice_id');
			$table->integer('payment_method_id');
			$table->date('paid_at');
			$table->decimal('amount', 10, 2)->default(0.00);
			$table->text('note');

			$table->index('invoice_id');
			$table->index('payment_method_id');
			$table->index('amount');
		});

		Schema::create('payment_methods', function($table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
		});

		Schema::create('quotes', function($table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->integer('invoice_id')->default('0');
			$table->integer('user_id');
			$table->integer('client_id');
			$table->integer('invoice_group_id');
			$table->integer('quote_status_id');
			$table->date('expires_at');
			$table->string('number');
			$table->string('url_key');

			$table->index('user_id');
			$table->index('client_id');
			$table->index('invoice_group_id');
			$table->index('number');
		});

		Schema::create('quote_amounts', function($table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->integer('quote_id');
			$table->decimal('item_subtotal', 10, 2)->default(0.00);
			$table->decimal('item_tax_total', 10, 2)->default(0.00);
			$table->decimal('tax_total', 10, 2)->default(0.00);
			$table->decimal('total', 10, 2)->default(0.00);

			$table->index('quote_id');
		});

		Schema::create('quote_items', function($table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->integer('quote_id');
			$table->integer('tax_rate_id');
			$table->string('name');
			$table->text('description');
			$table->decimal('quantity', 10, 2)->default(0.00);
			$table->decimal('price', 10, 2)->default(0.00);
			$table->integer('display_order');

			$table->index('quote_id');
			$table->index('display_order');
			$table->index('tax_rate_id');
		});

		Schema::create('quote_item_amounts', function($table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->integer('item_id');
			$table->decimal('subtotal', 10, 2)->default(0.00);
			$table->decimal('tax_total', 10, 2)->default(0.00);
			$table->decimal('total', 10, 2)->default(0.00);

			$table->index('item_id');
		});

		Schema::create('quote_tax_rates', function($table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->integer('quote_id');
			$table->integer('tax_rate_id');
			$table->boolean('include_item_tax')->default(0);
			$table->decimal('tax_total', 10, 2)->default(0.00);

			$table->index('quote_id');
			$table->index('tax_rate_id');
		});

		Schema::create('settings', function($table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->string('setting_key');
			$table->text('setting_value');

			$table->index('setting_key');
		});

		Schema::create('tax_rates', function($table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->decimal('percent', 5, 2)->default(0.00);
		});

		Schema::create('users', function($table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->string('email');
			$table->string('password');
			$table->string('name');
			$table->string('company')->nullable();
			$table->string('address_1')->nullable();
			$table->string('address_2')->nullable();
			$table->string('city')->nullable();
			$table->string('state')->nullable();
			$table->string('zip')->nullable();
			$table->string('country')->nullable();
			$table->string('phone')->nullable();
			$table->string('fax')->nullable();
			$table->string('mobile')->nullable();
			$table->string('web')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('clients');
		Schema::drop('client_notes');
		Schema::drop('email_templates');
		Schema::drop('invoices');
		Schema::drop('invoice_amounts');
		Schema::drop('invoice_groups');
		Schema::drop('invoice_items');
		Schema::drop('invoice_item_amounts');
		Schema::drop('invoice_tax_rates');
		Schema::drop('item_lookups');
		Schema::drop('payments');
		Schema::drop('payment_methods');
		Schema::drop('quotes');
		Schema::drop('quote_amounts');
		Schema::drop('quote_items');
		Schema::drop('quote_item_amounts');
		Schema::drop('quote_tax_rates');
		Schema::drop('settings');
		Schema::drop('tax_rates');
		Schema::drop('users');
	}

}