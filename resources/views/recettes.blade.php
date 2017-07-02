@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                @foreach ($recettes as $recette)
                    <h2>{{ $recette->recettes_name }} <small>{{ $recette->type_id }}</small></h2>
                @endforeach
            </div>
        </div>
    </div>
@endsection