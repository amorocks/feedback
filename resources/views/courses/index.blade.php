@extends('layouts.app')

@section('buttons')
	<a href="{{ route('courses.create') }}" class="btn btn-outline-light"><i class="fas fa-plus"></i> Nieuw vak</a>
@endsection

@section('content')
<ul class="list-unstyled">
	@foreach($courses as $course)
		<li>
			<a href="{{ route('courses.show', $course) }}"
				@if(!$course->active)
					class="text-muted"
				@endif
				>
				<h2>{{ $course->title }}</h2>
				<p>{{ $course->group }}, {{ $course->year }}, {{ $course->creator }}</p>
			</a>
		</li>
	@endforeach
</ul>
@endsection
