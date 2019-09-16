<p>Ha {{ $data['firstname'] }},</p>
<p>Ik heb feedback voor je geschreven over {{ $course->title }},  {{ $lesson->title ?? $lesson->date }}. Hopelijk kun je deze feedback gebruiken in de volgende les!</p>
<p><strong>{{ nl2br($data['message']) }}</strong></p>

@if(isset($data['options']))
	<p><em>Tags: {{ implode(', ', $data['options']) }}</em></p>
@endif

<br>
<p>Met vriendelijke groet,<br>{{ $sender->name }}</p>
