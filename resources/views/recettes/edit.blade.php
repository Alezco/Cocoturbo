@extends('layouts.app')
@section('content')
    <div class="container">

        <h1>Edit {{ $recette->recettes_name }}</h1>

        <!-- if there are creation errors, they will show here -->
        {{ HTML::ul($errors->all()) }}

        {{ Form::model($recette, array('route' => array('recettes.update', $recette->id), 'method' => 'PUT')) }}

        <div class="form-group">
            {{ Form::label('name', 'Name') }}
            {{ Form::text('name', null, array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::label('type', 'Type') }}
            {{ Form::select('type', $types) }}
        </div>

        {{ Form::submit('Edit the Nerd!', array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}
    </div>
@endsection