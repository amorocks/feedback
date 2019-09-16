@extends('layouts.app')

@section('buttons')
    <a class="btn btn-outline-light" href="{{ URL::previous() }}">
        <i class="fas fa-times" aria-hidden="true"></i> <span>Annuleren</span>
    </a>
@endsection

@section('content')
  
  <h2>Weet je het zeker?</h2>
  <p>Je staat op het punt het hele vak <strong>{{ $course->title }}</strong> en onderliggende lessen te verwijderen.</p>
  
  <form method="POST" action="{{ route('courses.destroy', $course) }}">
    @method('DELETE')
    @csrf
    <button type="submit" class="btn btn-danger">
      <i class="far fa-trash-alt" aria-hidden="true"></i> Ga door met verwijderen
    </button>
  </form>
    
@endsection
