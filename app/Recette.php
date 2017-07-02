<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recette extends Model
{
    protected $fillable = array('recettes_name', 'description', 'image_url', 'created_at', 'updated_at');

    public function type(){
        return $this->hasOne('App\RecetteType', 'id', 'type_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function favorites()
    {
        return $this->hasMany('App\Comment');
    }
}
