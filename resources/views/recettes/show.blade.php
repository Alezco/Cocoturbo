@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Showing {{ $recette->recettes_name }}</h1>
        <div class="jumbotron text-center">
            <h2>{{ $recette->recettes_name }}</h2>
            <p>
                <strong>Type de plat :</strong> {{ $type->type_name }} <br />
                <strong>Description :</strong> <br /> {!! nl2br(e($recette->description)) !!}
                {{ HTML::image($recette->image_url) }}
            </p>
        </div>
        <br />
    </div>
@endsection