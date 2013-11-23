<table id="item-table" class="items table table-striped table-bordered">
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
				<input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
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
		
		@foreach ($invoice->items as $item)
		<tr class="item">
			<td style="vertical-align: top;">
				<input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
				<input type="hidden" name="item_id" value="{{ $item->id }}">
				<input type="text" name="item_name" style="width: 90%;" value="{{ $item->name }}">
			</td>
            <td><textarea name="item_description" style="width: 90%;">{{ $item->description }}</textarea></td>
			<td style="vertical-align: top;"><input type="text" name="item_quantity" style="width: 90%;" value="{{ $item->formatted_quantity }}"></td>
			<td style="vertical-align: top;"><input type="text" name="item_price" style="width: 90%;" value="{{ $item->formatted_numeric_price }}"></td>
			<td style="vertical-align: top;">
				{{ Form::select('item_tax_rate_id', $taxRates, $item->tax_rate_id, array('class' => 'input-small')) }}
			</td>
			<td style="vertical-align: top;"><span name="subtotal">{{ $item->amount->formatted_subtotal }}</span></td>
			<td style="vertical-align: top;"><span name="item_tax_total">{{ $item->amount->formatted_tax_total }}</span></td>
			<td style="vertical-align: top;"><span name="item_total">{{ $item->amount->formatted_total }}</span></td>
			<td style="vertical-align: top;">
				<a href="{{ route('invoices.items.delete', array($invoice->id, $item->id)) }}" title="{{ trans('fi.delete') }}">
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
			<th>{{ trans('fi.invoice_tax') }}</th>
			<th>{{ trans('fi.total') }}</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>{{ $invoice->amount->formatted_item_subtotal }}</td>
			<td>{{ $invoice->amount->formatted_item_tax_total }}</td>
			<td>
			@foreach ($invoiceTaxRates as $invoiceTaxRate)
			{{ $invoiceTaxRate->taxRate->name . ' - ' . $invoiceTaxRate->formatted_tax_total }}
			<a href="{{ route('invoices.ajax.deleteInvoiceTax', array($invoice->id, $invoiceTaxRate->id)) }}">x</a><br>
			@endforeach
			</td>
			<td>{{ $invoice->amount->formatted_total }}</td>
		</tr>
	</tbody>
</table>