@extends('layouts.app')

@section('buttons')
    <a class="btn btn-outline-light" href="{{ URL::previous() }}">
        <i class="fas fa-times" aria-hidden="true"></i> <span>Annuleren</span>
    </a>
@endsection

@section('content')

    @if($lesson->exists)
        <h3>Les aanpassen</h3>
        <form method="POST" action="{{ route('courses.lessons.update', [$course, $lesson]) }}">
        {{ method_field('PATCH') }}
    @else
        <h3>Nieuwe les maken </h3>
        <form method="POST" action="{{ route('courses.lessons.store', $course) }}">
    @endif

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Titel</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="title" value="{{ old('title', $lesson->title) }}">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Datum *</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" required name="date" value="{{ old('date', ($lesson->date ?? date('Y-m-d'))) }}">
            </div>
        </div>
        
        {{ csrf_field() }}

        <button type="submit" class="btn btn-success">
            <i class="far fa-save" aria-hidden="true"></i> Opslaan
        </button>


        @if($lesson->exists)
        <a class="btn btn-danger" href="{{ route('courses.lessons.delete', [$course, $lesson]) }}">
            <i class="far fa-trash-alt" aria-hidden="true"></i> Verwijderen
        </a>
        @endif

    </form>

@endsection
