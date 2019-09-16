@extends('layouts.app')

@section('buttons')
	<a href="{{ route('courses.lessons.delete', [$course, $lesson]) }}" class="btn btn-outline-light"><i class="fas fa-trash"></i> Verwijderen</a>
@endsection

@section('content')

<h2 class="mb-0">{{ $course->title }} / {{ $lesson->title ?? $lesson->date }}</h2>
<p class="lead mt-0">{{ $course->group }}, {{ $course->year }}</p>
<hr class="my-4">


<form action="{{ route('messages.save', [$course, $lesson]) }}" method="POST" class="row">

	<div class="col-md-6">
		@foreach($users as $user)
			
			<fieldset class="form-group my-5">
				<legend>{{ trim($user['name']) }}</legend>
				<input type="hidden" name="users[{{ $user['id'] }}][id]" value="{{ $user['id'] }}">
				<input type="hidden" name="users[{{ $user['id'] }}][name]" value="{{ $user['name'] }}">
				<textarea class="form-control" name="users[{{ $user['id'] }}][message]" rows="5">{{ $user->pivot->message ?? '' }}</textarea>
				
				@foreach($course->options ?? array() as $option)
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="checkbox" name="users[{{ $user['id'] }}][options][]" 
							value="{{ $option }}" id="cb{{ $user['id'] . $option }}" 
							@if(in_array($option, $user->pivot->options ?? array()))
								checked
							@endif
						>
						<label class="form-check-label" for="cb{{ $user['id'] . $option }}">{{ ucfirst($option) }}</label>
					</div>
				
				@endforeach

			</fieldset>

			@if($loop->iteration == floor($loop->count / 2))
				</div>
				<!-- break off the column, when we're halfway down the array -->
				<div class="col-md-6">
			@endif

		@endforeach
	</div>

	{{ csrf_field() }}

	<div class="col-md-12 mb-4">
		<hr class="my-4">
		<button type="submit" class="btn btn-secondary" name="submit" value="concept">
		    <i class="far fa-save" aria-hidden="true"></i> Opslaan als concept
		</button>
		<button type="submit" class="btn btn-success" name="submit" value="close">
		    <i class="fas fa-lock" aria-hidden="true"></i> Opslaan &amp; sluiten
		</button>
	</div>

</form>
@endsection
