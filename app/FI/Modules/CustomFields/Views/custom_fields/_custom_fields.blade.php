@foreach ($customFields as $customField)
<div class="control-group">
	<label class="control-label">{{ $customField->field_label }}</label>
	<div class="controls">
		@if ($customField->field_type == 'dropdown')
		{{ Form::select('custom[' . $customField->column_name . ']', array_combine(array_merge(array(''), explode(',', $customField->field_meta)), array_merge(array(''), explode(',', $customField->field_meta))), null, array('class' => 'custom-form-field', 'data-field-name' => $customField->column_name)) }}
		@else
		{{ Form::{$customField->field_type}('custom[' . $customField->column_name . ']', null, array('class' => 'custom-form-field', 'data-field-name' => $customField->column_name)) }}
		@endif
	</div>
</div>
@endforeach