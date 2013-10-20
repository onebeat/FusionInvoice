<?php namespace FI\Storage\Eloquent\Repositories;

use \FI\Storage\Eloquent\Models\EmailTemplate;

class EmailTemplateRepository implements \FI\Storage\Interfaces\EmailTemplateRepositoryInterface {
	
	public function all()
	{
		return EmailTemplate::all();
	}

	public function getPaged($page = 1, $numPerPage = null)
	{
		\DB::getPaginator()->setCurrentPage($page);
		return EmailTemplate::paginate($numPerPage ?: \Config::get('defaultNumPerPage'));
	}

	public function find($id)
	{
		return EmailTemplate::find($id);
	}

	public function lists()
	{
		return array_merge(['0' => trans('fi.none')], EmailTemplate::lists('name', 'id'));
	}
	
	public function create($input)
	{
		EmailTemplate::create($input);
	}
	
	public function update($input, $id)
	{
		$emailTemplate = EmailTemplate::find($id);
		$emailTemplate->fill($input);
		$emailTemplate->save();
	}
	
	public function delete($id)
	{
		EmailTemplate::destroy($id);
	}
	
}