<?php namespace FI\Storage\Eloquent\Repositories;

use \FI\Storage\Eloquent\Models\QuoteItemAmount;

class QuoteItemAmountRepository implements \FI\Storage\Interfaces\QuoteItemAmountRepositoryInterface {
	
	public function find($id)
	{
		return QuoteItemAmount::find($id);
	}
	
	public function create($input)
	{
		QuoteItemAmount::create($input);
	}
	
	public function update($input, $id)
	{
		$quoteAmount = QuoteItemAmount::find($id);
		$quoteAmount->fill($input);
		$quoteAmount->save();
	}
	
	public function delete($id)
	{
		QuoteItemAmount::destroy($id);
	}
	
}