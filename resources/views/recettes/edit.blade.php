@extends('layouts.app')
@section('content')
    <div class="container">

        <h1>Modifier {{ $recette->recettes_name }}</h1>

        <!-- if there are creation errors, they will show here -->
        {{ HTML::ul($errors->all()) }}

        {{ Form::model($recette, array('route' => array('recettes.update', $recette->id), 'method' => 'PUT')) }}

        <div class="form-group">
            {{ Form::label('name', 'Nom') }}
            {{ Form::text('name', null, array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('description', 'Description') }}
            {{ Form::text('description', Input::old('description'), array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('image', "URL de l'image") }}
            {{ Form::text('image', Input::old('image'), array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('type', 'Type') }}
            {{ Form::select('type', $types) }}
        </div>

        {{ Form::submit('Modifier la recette !', array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}
    </div>
@endsection