@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $recette->recettes_name }}</h1>
        <div class="jumbotron text-center">
            <h2>{{ $recette->recettes_name }}</h2>
            <p>
                <strong>Type de plat :</strong> {{ $type->type_name }} <br />
                <strong>Description :</strong> <br /> {!! nl2br(e($recette->description)) !!}
                {{ HTML::image($recette->image_url) }}
            </p>
        </div>
        <br />
        @if( Auth::check() )
            @if (count($favorites) == 0)
                @include('favorites.create')
            @else
                <p>Cette rectette est deja dans vos favoris</p>
            @endif
            @foreach($comments as $commente)
                <div class="row">
                    <div class="col-sm-1">
                        <div class="thumbnail">
                            <img class="img-responsive user-photo" src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png">
                        </div><!-- /thumbnail -->
                    </div><!-- /col-sm-1 -->
                    <div class="col-sm-5">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <strong>{{$commente->user->name}}</strong> <span class="text-muted">{{$commente->updated_at}}</span>
                            </div>
                            <div class="panel-body">
                                {{$commente->comment_content}}
                            </div><!-- /panel-body -->
                        </div><!-- /panel panel-default -->
                    </div><!-- /col-sm-5 -->
                </div>
            @endforeach
            @include('comments.create')
        @endif
    </div>
@endsection