@extends('layouts.app')

@section('content')
<div class="container">
    <h1>All the recettes</h1>
    <a class="btn btn-small btn-success" href="{{ URL::to('recettes/create') }}">Create recettes</a>


    <!-- will be used to show any messages -->
    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <td>Name</td>
            <td>Type</td>
            <td>Actions</td>
        </tr>
        </thead>
        <tbody>
        @foreach($recettes as $key => $value)
            <tr>
                <td>{{ $value->recettes_name }}</td>
                <td>{{ $value->type_id }}</td>
                <!-- we will also add show, edit, and delete buttons -->
                <td>
                    <!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
                    <!-- we will add this later since its a little more complicated than the other two buttons -->
                    <!-- show the nerd (uses the show method found at GET /nerds/{id} -->
                    <a class="btn btn-small btn-success" href="{{ URL::to('recettes/' . $value->id) }}">Show this recettes</a>
                    <!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
                    <a class="btn btn-small btn-info" href="{{ URL::to('recettes/' . $value->id . '/edit') }}">Edit this recettes</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection