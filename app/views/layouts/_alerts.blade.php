@foreach ($errors->all('<div class="alert alert-error">:message</div>') as $error)
{{ $error }}
@endforeach

@if (Session::has('alert'))
<div class="alert">{{ Session::get('alert') }}</div>
@endif

@if (Session::has('alert_success'))
<div class="alert alert-success">{{ Session::get('alert_success') }}</div>
@endif

@if (Session::has('alert_info'))
<div class="alert alert-info">{{ Session::get('alert_info') }}</div>
@endif