<script type="text/javascript">
    $(function()
    {
        // Display the create invoice modal
        $('#modal-choose-items').modal('show');

        // Creates the invoice
        $('#select-items-confirm').click(function()
        {
            var item_lookup_ids = [];
            
            $("input[name='item_lookup_ids[]']:checked").each(function ()
            {
                item_lookup_ids.push(parseInt($(this).val()));
            });
            
            $.post("{{ route('itemLookups.ajax.process') }}", {
                item_lookup_ids: item_lookup_ids
            }, function(items) {
                for(var key in items) {
                    if ($('#item-table tr:last input[name=item_name]').val() !== '') {
                        $('#new-item').clone().appendTo('#item-table').removeAttr('id').addClass('item').show();
                    }
                    $('#item-table tr:last input[name=item_name]').val(items[key].name);
                    $('#item-table tr:last textarea[name=item_description]').val(items[key].description);
                    $('#item-table tr:last input[name=item_price]').val(items[key].price);
                    $('#item-table tr:last input[name=item_quantity]').val('1');
                    
                    $('#modal-choose-items').modal('hide');
                }
            });
        });
    });

</script>

<div id="modal-choose-items" class="modal hide">
	<form class="form-horizontal">
		<div class="modal-header">
			<a data-dismiss="modal" class="close">x</a>
			<h3>{{ trans('fi.add_item_from_lookup') }}</h3>
		</div>
		<div class="modal-body">
			
            <table class="table table-bordered table-striped">
                <tr>
                    <th></th>
                    <th>{{ trans('fi.item') }}</th>
                    <th>{{ trans('fi.description') }}</th>
                    <th>{{ trans('fi.price') }}</th>
                </tr>
                @foreach ($items as $item)
                <tr>
                    <td><input type="checkbox" name="item_lookup_ids[]" value="{{ $item->id }}"></td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->price }}</td>
                </tr>
                @endforeach
            </table>

		</div>

		<div class="modal-footer">
            <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="icon-white icon-remove"></i> {{ trans('fi.cancel') }}</button>
			<button class="btn btn-primary" id="select-items-confirm" type="button"><i class="icon-white icon-ok"></i> {{ trans('fi.submit') }}</button>
		</div>

	</form>

</div>