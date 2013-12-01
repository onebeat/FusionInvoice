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

	public function find($emailTemplateId)
	{
		return EmailTemplate::find($emailTemplateId);
	}

	public function lists()
	{
		return array_merge(array('0' => trans('fi.none')), EmailTemplate::lists('name', 'id'));
	}
	
	public function create($name, $subject, $body)
	{
		EmailTemplate::create(
			array(
				'name'    => $name,
				'subject' => $subject,
				'body'    => $body
			)
		);
	}
	
	public function update($emailTemplateId, $name, $subject, $body)
	{
		$emailTemplate = EmailTemplate::find($emailTemplateId);

		$emailTemplate->fill(
			array(
				'name'    => $name,
				'subject' => $subject,
				'body'    => $body
			)
		);

		$emailTemplate->save();
	}
	
	public function delete($emailTemplateId)
	{
		EmailTemplate::destroy($emailTemplateId);
	}
	
}