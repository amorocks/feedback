@extends('layouts.app')

@section('buttons')
    <a class="btn btn-outline-light" href="{{ URL::previous() }}">
        <i class="fas fa-times" aria-hidden="true"></i> <span>Annuleren</span>
    </a>
@endsection

@section('content')
  
  <h2>Weet je het zeker?</h2>
  <p>Je staat op het punt de les <strong>{{ $course->title }} &gt; {{ $lesson->title ?? $lesson->date }}</strong> en alle feedback te verwijderen.</p>
  
  <form method="POST" action="{{ route('courses.lessons.destroy', [$course, $lesson]) }}">
    @method('DELETE')
    @csrf
    <button type="submit" class="btn btn-danger">
      <i class="far fa-trash-alt" aria-hidden="true"></i> Ga door met verwijderen
    </button>
  </form>
    
@endsection
