@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Showing {{ $recette->recettes_name }}</h1>
        <div class="jumbotron text-center">
            <h2>{{ $recette->recettes_name }}</h2>
            <p>
                <strong>Level:</strong> {{ $recette->type_id }}
            </p>
        </div>
    </div>
@endsection