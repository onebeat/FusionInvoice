<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="utf-8">
</head>
<body>
	<h2>{{ $quote->user->company }}</h2>

	<div>
		<p>To view your quote from {{ $quote->user->name }} for {{ $quote->amount->formatted_total }}, click the link below:</p>

		<p>{{ route('public.quote.show', array($quote->url_key)) }}
	</div>
</body>
</html>