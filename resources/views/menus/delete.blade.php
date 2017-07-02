{{ Form::open(array('url' => 'menus/delete/'.$menu->id)) }}
{{ Form::hidden('_method', 'DELETE') }}

{{ Form::submit('Supprimer', array('class' => 'btn btn-danger')) }}

{{ Form::close() }}