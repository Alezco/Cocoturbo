{{ HTML::ul($errors->all()) }}

{{ Form::open(array('url' => 'comments/create')) }}

<div class="form-group">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      {{ Form::label('content', 'Commentaire') }}
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <fieldset class="rating">
        {{ Form::radio('rating', "5", false, array('id' => 'star5')) }}<label class = "full" for="star5" title="Awesome"></label>
        {{ Form::radio('rating', "4", false, array('id' => 'star4')) }}<label class = "full" for="star4" title="Good"></label>
        {{ Form::radio('rating', "3", false, array('id' => 'star3')) }}<label class = "full" for="star3" title="Meh"></label>
        {{ Form::radio('rating', "2", false, array('id' => 'star2')) }}<label class = "full" for="star2" title="Bad"></label>
        {{ Form::radio('rating', "1", false, array('id' => 'star1')) }}<label class = "full" for="star1" title="Horrible"></label>
      </fieldset>
    </div>
  </div>
    {{ Form::text('content', Input::old('content'), array('class' => 'form-control')) }}
</div>
{{ Form::hidden('user_id', Auth::user()->id) }}
{{ Form::hidden('recette_id', $recette->id) }}

{{ Form::submit('Poster le commentaire', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}
