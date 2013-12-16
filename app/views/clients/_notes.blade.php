@foreach ($clientNotes as $note)
<div class="alert alert-info">
	<p><strong>{{ $note->formatted_created_at }}</strong>: {{ $note->formatted_note }}</p>
</div>
@endforeach