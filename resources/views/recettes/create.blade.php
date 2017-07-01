@extends('layouts.app')

@section('content')
<div class="container">
<h1>Create a Nerd</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::open(array('url' => 'recettes')) }}

<div class="form-group">
    {{ Form::label('name', 'Name') }}
    {{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('type', 'Type') }}
    {{ Form::select('type', $types) }}
</div>

{{ Form::submit('Creer la recette!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

</div>
@endsection