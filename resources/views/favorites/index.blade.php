@extends('layouts.app')
{{ HTML::style('css/recettes_list.css') }}
@section('content')
    <div class="container">
        <h1>Carnet de recettes</h1>
    <!-- will be used to show any messages -->
        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
        @foreach($recettes as $favorite)
            <div class="row">
                <div class="col-xs-12 col-sm-3 col-md-3">
                    <a href="{{ URL::to('recettes/' . $favorite->recette->id) }}">
                        @if ($favorite->recette->image_url != "")
                            {{ HTML::image($favorite->recette->image_url, 'alt', array( 'width' => 250, 'height' => 250, 'class' => 'img-responsive img-box img-thumbnail' )) }}
                        @else
                            {{ HTML::image('http://www.dompteurs.com/blogue/wp-content/uploads/19-05-17-vlevis-campagneCompostage.jpg', 'alt', array( 'width' => 250, 'height' => 250, 'class' => 'img-responsive img-box img-thumbnail' )) }}
                        @endif

                    </a>
                </div>
                <div class="col-xs-12 col-sm-7 col-md-7">
                    <h4><a href="{{ URL::to('recettes/' . $favorite->recette->id) }}">{{ $favorite->recette->recettes_name }}</a></h4>
                    <strong>{{ $favorite->recette->type->type_name }}</strong>
                    <p>{{ $favorite->recette->description }}</p>
                </div>
                <div class="col-xs-12 col-sm-2 col-md-2">
                    @include('favorites.delete')
                </div>
            </div>
            <br />
            <br />
        @endforeach
    </div>
@endsection