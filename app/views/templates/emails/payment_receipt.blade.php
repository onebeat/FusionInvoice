<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="utf-8">
</head>
<body>
	<h2>{{ $payment->invoice->user->company }}</h2>

	<div>
		<p>A payment of {{ $payment->formatted_amount }} has been applied to invoice #{{ $payment->invoice->number }}. Thank you!</p>
	</div>
</body>
</html>