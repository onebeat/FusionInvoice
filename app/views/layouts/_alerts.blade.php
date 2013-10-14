@foreach ($errors->all('<div class="alert alert-error">:message</div>') as $error)
{{ $error }}
@endforeach

@if (Session::has('alert'))
<div class="alert">{{ Session::get('alert') }}</div>
@endif