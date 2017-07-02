{{ Form::open(array('url' => 'favorite/delete/'.$favorite->id)) }}
{{ Form::hidden('_method', 'DELETE') }}

{{ Form::submit('Supprimer', array('class' => 'btn btn-danger')) }}

{{ Form::close() }}