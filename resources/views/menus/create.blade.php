@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create a Menu</h1>
        <!-- if there are creation errors, they will show here -->
        {{ HTML::ul($errors->all()) }}

        {{ Form::open(array('url' => 'menus')) }}
        {{ Form::hidden('user_id', Auth::user()->id) }}
        <div class="form-group">
            {{ Form::label('menu_title', 'Nom du menu') }}
            {{ Form::text('menu_title', Input::old('menu_title'), array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('entree', 'Entree') }}
            {{ Form::select('entree', $entrees) }}
        </div>
        <div class="form-group">
            {{ Form::label('plat', 'Plat') }}
            {{ Form::select('plat', $plats) }}
        </div>
        <div class="form-group">
            {{ Form::label('dessert', 'Dessert') }}
            {{ Form::select('dessert', $desserts) }}
        </div>

        {{ Form::submit('Creer la menu!', array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}

    </div>
@endsection