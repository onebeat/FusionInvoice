<?php namespace FI\Storage\Interfaces;

interface CustomFieldRepositoryInterface {

	/**
	 * Get a list of all records
	 * @return CustomField
	 */	
	public function all();

	/**
	 * Get a paged list of records
	 * @param  int $page
	 * @param  int  $numPerPage
	 * @return CustomField
	 */
	public function getPaged($page, $numPerPage);

	/**
	 * Get a single record
	 * @param  int $id
	 * @return CustomField
	 */	
	public function find($id);

	/**
	 * Get a list by table name
	 * @param  string $table
	 * @return CustomField
	 */
	public function getByTable($table);

	/**
	 * Create a record
	 * @param  array $input
	 * @return int
	 */	
	public function create($input);

	/**
	 * Update a record
	 * @param  array $input
	 * @param  int $id
	 * @return void
	 */	
	public function update($input, $id);

	/**
	 * Delete a record
	 * @param  int $id
	 * @return void
	 */	
	public function delete($id);

	/**
	 * Obtains the new column name (incremental) to add for a custom field
	 * @param  string $tableName
	 * @return string
	 */
	public function getNextColumnName($tableName);

	/**
	 * Creates the new column
	 * @param  string $tableName
	 * @param  string $columnName
	 * @return void
	 */
	public function createCustomColumn($tableName, $columnName);

	/**
	 * Drops a custom column
	 * @param  string $tableName
	 * @param  string $columnName
	 * @return void
	 */
	public function deleteCustomColumn($tableName, $columnName);

}