<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="utf-8">
</head>
<body>
	<h2>{{ $invoice->user->company }}</h2>

	<div>
		<p>To view your invoice from {{ $invoice->user->name }} for {{ $invoice->amount->formatted_total }}, click the link below:</p>

		<p>{{ route('public.invoice.show', array($invoice->url_key)) }}
	</div>
</body>
</html>