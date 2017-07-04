@extends('layouts.app')
{{ HTML::style('css/recettes_list.css') }}
@section('content')
    <div class="container">
        <h1>Toutes les recettes</h1>
        @include('recettes.search')
        @if( Auth::check() )
            <a class="btn btn-small btn-success" href="{{ URL::to('recettes/create') }}">Créer une recette</a>
            <br/> <br />
        @endif

        <!-- will be used to show any messages -->
        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
        @foreach($recettes as $key => $value)
            <div class="row">
                <div class="col-xs-12 col-sm-3 col-md-3">
                    <a href="{{ URL::to('recettes/' . $value->id) }}">
                        {{ HTML::image($value->image_url, 'alt', array( 'width' => 250, 'height' => 250, 'class' => 'img-responsive img-box img-thumbnail' )) }}
                    </a>
                </div>
                <div class="col-xs-12 col-sm-9 col-md-9">
                    <h4><a href="{{ URL::to('recettes/' . $value->id) }}">{{ $value->recettes_name }}</a></h4>
                    <strong>{{ $value->type->type_name }}</strong>
                    <p>{{ $value->description }}</p>
                </div>
            </div>
            <br />
            <br />
        @endforeach
    </div>
@endsection