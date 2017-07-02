@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Showing <strong>{{ $menu[0]->menu_title }}</strong></h1>
    </div>
    <div id="exTab1" class="container">
        <ul  class="nav nav-pills">
            <li class="active"><a  href="#1a" data-toggle="tab">Entree</a></li>
            <li><a href="#2a" data-toggle="tab">Plat</a></li>
            <li><a href="#3a" data-toggle="tab">Dessert</a></li>
        </ul>

        <div class="tab-content clearfix">
            <div class="tab-pane active" id="1a">
                <div class="row">
                    <div class="col-xs-12 col-sm-3 col-md-3">
                        <a href="{{ URL::to('recettes/' . $menu[0]->entree->id) }}">
                            {{ HTML::image($menu[0]->entree->image_url, 'alt', array( 'width' => 250, 'height' => 250, 'class' => 'img-responsive img-box img-thumbnail' )) }}
                        </a>
                    </div>
                    <div class="col-xs-12 col-sm-9 col-md-9">
                        <h4><a href="{{ URL::to('recettes/' . $menu[0]->entree->id) }}">{{ $menu[0]->entree->recettes_name }}</a></h4>
                        <p>{{ $menu[0]->entree->description }}</p>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="2a">
                <div class="row">
                    <div class="col-xs-12 col-sm-3 col-md-3">
                        <a href="{{ URL::to('recettes/' . $menu[0]->plat->id) }}">
                            {{ HTML::image($menu[0]->plat->image_url, 'alt', array( 'width' => 250, 'height' => 250, 'class' => 'img-responsive img-box img-thumbnail' )) }}
                        </a>
                    </div>
                    <div class="col-xs-12 col-sm-9 col-md-9">
                        <h4><a href="{{ URL::to('recettes/' . $menu[0]->plat->id) }}">{{ $menu[0]->plat->recettes_name }}</a></h4>
                        <p>{{ $menu[0]->plat->description }}</p>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="3a">
                <div class="row">
                    <div class="col-xs-12 col-sm-3 col-md-3">
                        <a href="{{ URL::to('recettes/' . $menu[0]->dessert->id) }}">
                            {{ HTML::image($menu[0]->dessert->image_url, 'alt', array( 'width' => 250, 'height' => 250, 'class' => 'img-responsive img-box img-thumbnail' )) }}
                        </a>
                    </div>
                    <div class="col-xs-12 col-sm-9 col-md-9">
                        <h4><a href="{{ URL::to('recettes/' . $menu[0]->dessert->id) }}">{{ $menu[0]->dessert->recettes_name }}</a></h4>
                        <strong>{{ $menu[0]->dessert->type->type_name }}</strong>
                        <p>{{ $menu[0]->dessert->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection