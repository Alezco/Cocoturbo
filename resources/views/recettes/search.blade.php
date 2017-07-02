{!! Form::open(['method'=>'GET','url'=>'recettes','role'=>'search'])  !!}

<div class="input-group custom-search-form">
    <input type="text" class="form-control" name="search" placeholder="Search..." value={{$search}}>
    <span class="input-group-btn">
        <button class="btn btn-default-sm" type="submit">
            <i class="fa fa-search">search</i>
        </button>
    </span>
</div>
{!! Form::close() !!}