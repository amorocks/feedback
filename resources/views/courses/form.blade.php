@extends('layouts.app')

@section('buttons')
    <a class="btn btn-outline-light" href="{{ URL::previous() }}">
        <i class="fas fa-times" aria-hidden="true"></i> <span>Annuleren</span>
    </a>
@endsection

@section('content')

    @if($course->exists)
        <h3>Vak aanpassen</h3>
        <form method="POST" action="{{ route('courses.update', $course) }}">
        {{ method_field('PATCH') }}
    @else
        <h3>Nieuw vak maken </h3>
        <form method="POST" action="{{ route('courses.store') }}">
    @endif

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Titel</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" required name="title" value="{{ old('title', $course->title) }}">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Schooljaar</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="year" value="{{ old('year', $course->year) }}">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Klas</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="group" value="{{ old('group', $course->group) }}" placeholder="RIO4-AMO1A">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Opties</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="options" value="{{ old('options', implode(', ', ($course->options ?? array()))) }}" placeholder="Voorzitter, Notulist, Presentator">
                <small class="form-text text-muted">
                    Een kommagescheiden lijst van aan/uit opties die je per les per student wil afvinken
                </small>
            </div>
        </div>
        
        {{ csrf_field() }}

        <button type="submit" class="btn btn-success">
            <i class="far fa-save" aria-hidden="true"></i> Opslaan
        </button>


        @if($course->exists)
        <a class="btn btn-danger" href="{{ route('courses.delete', $course) }}">
            <i class="far fa-trash-alt" aria-hidden="true"></i> Verwijderen
        </a>
        @endif

    </form>

@endsection
