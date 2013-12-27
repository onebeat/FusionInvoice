<?php namespace FI\Storage\Eloquent\Repositories;

use FI\Storage\Eloquent\Models\EmailTemplate;

class EmailTemplateRepository {
	
	/**
	 * Get all records
	 * @return EmailTemplate
	 */
	public function all()
	{
		return EmailTemplate::all();
	}

	/**
	 * Get a paged list of records
	 * @param  int $page
	 * @param  int $numPerPage
	 * @return EmailTemplate
	 */
	public function getPaged($page = 1, $numPerPage = null)
	{
		\DB::getPaginator()->setCurrentPage($page);
		return EmailTemplate::paginate($numPerPage ?: \Config::get('defaultNumPerPage'));
	}

	/**
	 * Get a single record
	 * @param  int $id
	 * @return EmailTemplate
	 */
	public function find($id)
	{
		return EmailTemplate::find($id);
	}

	/**
	 * Get a list of records formatted for dropdown
	 * @return array
	 */
	public function lists()
	{
		return array_merge(array('0' => trans('fi.none')), EmailTemplate::lists('name', 'id'));
	}
	
	/**
	 * Create a record
	 * @param  array $input
	 * @return int
	 */	
	public function create($input)
	{
		return EmailTemplate::create($input)->id;
	}
	
	/**
	 * Update a record
	 * @param  array $input
	 * @param  int $id
	 * @return void
	 */	
	public function update($input, $id)
	{
		$emailTemplate = EmailTemplate::find($id);

		$emailTemplate->fill($input);

		$emailTemplate->save();
	}
	
	/**
	 * Delete a record by id
	 * @param  int $id
	 * @return void
	 */
	public function delete($id)
	{
		EmailTemplate::destroy($id);
	}
	
}