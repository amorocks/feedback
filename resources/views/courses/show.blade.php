@extends('layouts.app')

@section('buttons')
	<div class="btn-group">
		<a href="{{ route('messages.overview', $course) }}" class="btn btn-outline-light"><i class="fas fa-eye"></i> Overzicht</a>
		
		@if($course->active)
			<a href="{{ route('courses.edit', $course) }}" class="btn btn-outline-light"><i class="fas fa-edit"></i> Aanpassen</a>
			<a href="{{ route('courses.lessons.create', $course) }}" class="btn btn-outline-light"><i class="fas fa-plus"></i> Nieuwe les</a>
		@endif
	</div>
@endsection

@section('content')
<ul class="list-unstyled">
	@foreach($lessons as $lesson)
		<li>
			<a href="{{ route('courses.lessons.show', [$course, $lesson]) }}">
				<h2>{{ $lesson->title ?? $lesson->date }}</h2>
			</a>
		</li>
	@endforeach
</ul>
@endsection
