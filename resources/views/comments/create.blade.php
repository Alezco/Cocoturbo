{{ Form::open(array('url' => 'comments/create')) }}

<div class="form-group">
    {{ Form::label('content', 'Commentaire') }}
    {{ Form::text('content', Input::old('content'), array('class' => 'form-control')) }}
</div>

{{ Form::hidden('user_id', Auth::user()->id) }}
{{ Form::hidden('recette_id', $recette->id) }}

{{ Form::submit('Poster le commentaire', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}