<?php namespace FI\Storage\Eloquent\Repositories;

use FI\Storage\Eloquent\Models\Quote;

class QuoteRepository implements \FI\Storage\Interfaces\QuoteRepositoryInterface {

	public function all()
	{
		return Quote::all();
	}

	public function getPagedByStatus($page = 1, $numPerPage = null, $status = 'all')
	{
		\DB::getPaginator()->setCurrentPage($page);

		switch ($status)
		{
			case 'draft':
				return Quote::draft()->paginate($numPerPage ?: \Config::get('defaultNumPerPage'));
				break;
			case 'sent':
				return Quote::sent()->paginate($numPerPage ?: \Config::get('defaultNumPerPage'));
				break;
			case 'viewed':
				return Quote::viewed()->paginate($numPerPage ?: \Config::get('defaultNumPerPage'));
				break;
			case 'approved':
				return Quote::approved()->paginate($numPerPage ?: \Config::get('defaultNumPerPage'));
				break;
			case 'rejected':
				return Quote::rejected()->paginate($numPerPage ?: \Config::get('defaultNumPerPage'));
				break;
			case 'canceled':
				return Quote::canceled()->paginate($numPerPage ?: \Config::get('defaultNumPerPage'));
				break;
			default:
				return Quote::paginate($numPerPage ?: \Config::get('defaultNumPerPage'));
		}
	}

	public function find($id)
	{
		return Quote::find($id);
	}
	
	public function create($input)
	{
		return Quote::create($input)->id;
	}
	
	public function update($input, $id)
	{
		$quote = Quote::find($id);
		$quote->fill($input);
		$quote->save();
	}
	
	public function delete($id)
	{
		Quote::destroy($id);
	}
	
}