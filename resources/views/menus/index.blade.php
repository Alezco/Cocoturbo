@extends('layouts.app')
{{ HTML::style('css/recettes_list.css') }}
@section('content')
    <div class="container">
        <h1>All the recettes</h1>
        <a class="btn btn-small btn-success" href="{{ URL::to('menus/create') }}">Create Menu</a>

    <!-- will be used to show any messages -->
        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
        @foreach($menus as $menu)
            <div class="row">
                <div class="col-xs-12 col-sm-3 col-md-3">
                    <a href="{{ URL::to('menus/' . $menu->id) }}">
                        @if ($menu->entree->image_url != "")
                            {{ HTML::image($menu->entree->image_url, 'alt', array( 'width' => 250, 'height' => 250, 'class' => 'img-responsive img-box img-thumbnail' )) }}
                        @else
                            {{ HTML::image('http://www.dompteurs.com/blogue/wp-content/uploads/19-05-17-vlevis-campagneCompostage.jpg', 'alt', array( 'width' => 250, 'height' => 250, 'class' => 'img-responsive img-box img-thumbnail' )) }}
                        @endif
                    </a>
                </div>
                <div class="col-xs-12 col-sm-7 col-md-7">
                    <h4><a href="{{ URL::to('menus/' . $menu->id) }}">{{ $menu->menu_title }}</a></h4>
                    <p>{{ $menu->entree->recettes_name }}</p>
                    <p>{{ $menu->plat->recettes_name }}</p>
                    <p>{{ $menu->dessert->recettes_name }}</p>
                </div>
                <div class="col-xs-12 col-sm-2 col-md-2">
                    @include('menus.delete')
                </div>
            </div>
            @endforeach
    </div>
@endsection