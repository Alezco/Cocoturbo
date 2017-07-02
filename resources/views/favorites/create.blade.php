{{ Form::open(array('url' => 'favorite/create')) }}

{{ Form::hidden('user_id', Auth::user()->id) }}
{{ Form::hidden('recette_id', $recette->id) }}

{{ Form::submit('Ajouter à mon carnet', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}