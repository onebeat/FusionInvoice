<table id="item_table" class="items table table-striped table-bordered">
	<thead>
		<tr>
			<th>{{ trans('fi.item') }}</th>
			<th style="min-width: 300px;">{{ trans('fi.description') }}</th>
			<th style="width: 100px;">{{ trans('fi.quantity') }}</th>
			<th style="width: 100px;">{{ trans('fi.price') }}</th>
			<th>{{ trans('fi.tax_rate') }}</th>
			<th>{{ trans('fi.subtotal') }}</th>
			<th>{{ trans('fi.tax') }}</th>
			<th>{{ trans('fi.total') }}</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		
		<tr id="new-item" style="display: none;">
			<td style="vertical-align: top;">
				<input type="hidden" name="quote_id" value="{{ $quote->id }}">
				<input type="hidden" name="item_id" value="">
				<input type="text" name="item_name" class="lookup-item-name" style="width: 90%;" data-typeahead=""><br>
                <label><input type="checkbox" name="save_item_as_lookup" tabindex="999"> {{ trans('fi.save_item_as_lookup') }}</label>
			</td>
            <td><textarea name="item_description" style="width: 90%;"></textarea></td>
			<td style="vertical-align: top;"><input type="text" class="input-mini" name="item_quantity" style="width: 90%;" value=""></td>
			<td style="vertical-align: top;"><input type="text" class="input-mini" name="item_price" style="width: 90%;" value=""></td>
			<td style="vertical-align: top;">
				{{ Form::select('item_tax_rate_id', $taxRates, Config::get('fi.itemTaxRate'), array('class' => 'input-small')) }}
			</td>
			<td style="vertical-align: top;"><span name="subtotal"></span></td>
			<td style="vertical-align: top;"><span name="item_tax_total"></span></td>
			<td style="vertical-align: top;"><span name="item_total"></span></td>
			<td></td>
		</tr>
		
		@foreach ($quote->items as $item)
		<tr class="item">
			<td style="vertical-align: top;">
				<input type="hidden" name="quote_id" value="{{ $quote->id }}">
				<input type="hidden" name="item_id" value="{{ $item->id }}">
				<input type="text" name="item_name" style="width: 90%;" value="{{ $item->name }}">
			</td>
            <td><textarea name="item_description" style="width: 90%;">{{ $item->description }}</textarea></td>
			<td style="vertical-align: top;"><input type="text" name="item_quantity" style="width: 90%;" value="{{ $item->quantity }}"></td>
			<td style="vertical-align: top;"><input type="text" name="item_price" style="width: 90%;" value="{{ $item->price }}"></td>
			<td style="vertical-align: top;">
				{{ Form::select('item_tax_rate_id', $taxRates, $item->tax_rate_id, array('class' => 'input-small')) }}
			</td>
			<td style="vertical-align: top;"><span name="subtotal">{{ $item->amount->subtotal }}</span></td>
			<td style="vertical-align: top;"><span name="item_tax_total">{{ $item->amount->tax_total }}</span></td>
			<td style="vertical-align: top;"><span name="item_total">{{ $item->amount->total }}</span></td>
			<td style="vertical-align: top;">
				<a href="{{ route('quotes.items.delete', array($quote->id, $item->id)) }}" title="{{ trans('fi.delete') }}">
					<i class="icon-remove"></i>
				</a>
			</td>
		</tr>
		@endforeach
		
	</tbody>

</table>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>{{ trans('fi.subtotal') }}</th>
			<th>{{ trans('fi.item_tax') }}</th>
			<th>{{ trans('fi.quote_tax') }}</th>
			<th>{{ trans('fi.total') }}</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>{{ $quote->amount->item_subtotal }}</td>
			<td>{{ $quote->amount->item_tax_total }}</td>
			<td>
			@TODO
			</td>
			<td>{{ $quote->amount->total }}</td>
		</tr>
	</tbody>
</table>