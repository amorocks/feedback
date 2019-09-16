@extends('layouts.app')

@section('content')

<h2 class="mb-0">{{ $course->title }} / {{ $lesson->title ?? $lesson->date }}</h2>
<p class="lead mt-0">{{ $course->group }}, {{ $course->year }}</p>
<hr class="my-4">


<div class="row">

	<div class="col-md-6">
		@foreach($users as $user)
			
			<div class="my-5">
				<h4>{{ trim($user['name']) }}</h4>
				<p>{!! nl2br($user->pivot->message) !!}</p>
				<p><em>{{ implode(', ', $user->pivot->options) }}</em></p>
			</div>

			@if($loop->iteration == floor($loop->count / 2))
				</div>
				<!-- break off the column, when we're halfway down the array -->
				<div class="col-md-6">
			@endif

		@endforeach
	</div>

</div>
@endsection
