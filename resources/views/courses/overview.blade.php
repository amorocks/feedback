@extends('layouts.app')
@section('container', 'container-fluid mt-4')

@section('buttons')
	<a href="{{ route('courses.close', $course) }}" class="btn btn-outline-light"><i class="fas fa-check"></i> Vak afsluiten</a>
@endsection

@section('content')

	<table class="table table-hover table-responsive" style="min-width: 100%;">
		
		<thead><tr>
			<th>&nbsp;</th>
			@foreach($lessons as $lesson)
				<th>{{ $lesson->title ?? $lesson->date }}</th>
			@endforeach
			<th>&nbsp;</th>
		</tr></thead>

		<tbody>
			@foreach($users as $user)
				<tr>
					<th>{{ $user->name }}</th>
					@foreach($user->data as $lesson)
						<td>
							{{ $lesson->pivot->message }} <br />
							<em>{{ implode(', ', $lesson->pivot->options) }}</em>
						</td>
					@endforeach
					<td>
						@foreach($user->counter as $option => $count)
							{{ $option }}: {{ $count }}<br />
						@endforeach
					</td>
				</tr>
			@endforeach
		</tbody>

	</table>

@endsection