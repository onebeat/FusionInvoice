<?php namespace FI\Storage\Eloquent\Repositories;

use FI\Storage\Eloquent\Models\CustomField;

class CustomFieldRepository implements \FI\Storage\Interfaces\CustomFieldRepositoryInterface {
	
	/**
	 * Get a list of all records
	 * @return CustomField
	 */
	public function all()
	{
		return CustomField::all();
	}

	/**
	 * Get a paged list of records
	 * @param  int $page
	 * @param  int  $numPerPage
	 * @return CustomField
	 */
	public function getPaged($page = 1, $numPerPage = null)
	{
		\DB::getPaginator()->setCurrentPage($page);
		return CustomField::orderBy('table_name', 'field_label')->paginate($numPerPage ?: \Config::get('defaultNumPerPage'));
	}

	/**
	 * Get a single record
	 * @param  int $id
	 * @return CustomField
	 */
	public function find($id)
	{
		return CustomField::find($id);
	}

	/**
	 * Get a list by table name
	 * @param  string $table
	 * @return CustomField
	 */
	public function getByTable($table)
	{
		return CustomField::forTable($table)->get();
	}

	/**
	 * Create a record
	 * @param  array $input
	 * @return int
	 */
	public function create($input)
	{
		return CustomField::create($input)->id;
	}
	
	/**
	 * Update a record
	 * @param  array $input
	 * @param  int $id
	 * @return void
	 */
	public function update($input, $id)
	{
		$customField = CustomField::find($id);

		$customField->fill($input);

		$customField->save();
	}
	
	/**
	 * Delete a record
	 * @param  int $id
	 * @return void
	 */
	public function delete($id)
	{
		CustomField::destroy($id);
	}

	/**
	 * Obtains the new column name (incremental) to add for a custom field
	 * @param  string $tableName
	 * @return string
	 */
	public function getNextColumnName($tableName)
	{
		$currentColumn = CustomField::where('table_name', '=', $tableName)->orderBy('column_name', 'DESC')->take(1)->first();

		if (!$currentColumn)
		{
			return 'column_1';
		}
		else
		{
			return ++$currentColumn->column_name;
		}
	}

	/**
	 * Creates the new column
	 * @param  string $tableName
	 * @param  string $columnName
	 * @return void
	 */
	public function createCustomColumn($tableName, $columnName)
	{
		if (substr($tableName, -7) <> '_custom')
		{
			$tableName = $tableName . '_custom';
		}

		\Schema::table($tableName, function($table) use ($columnName)
		{
			$table->string($columnName);
		});
	}

	/**
	 * Drops a custom column
	 * @param  string $tableName
	 * @param  string $columnName
	 * @return void
	 */
	public function deleteCustomColumn($tableName, $columnName)
	{
		if (substr($tableName, -7) <> '_custom')
		{
			$tableName = $tableName . '_custom';
		}

		if (\Schema::hasColumn($tableName, $columnName))
		{
			\Schema::table($tableName, function ($table) use ($columnName)
			{
				$table->dropColumn($columnName);
			});
		}
	}
	
}