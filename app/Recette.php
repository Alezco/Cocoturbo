<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recette extends Model
{
    protected $fillable = array('recettes_name', 'description', 'image_url', 'created_at', 'updated_at');

    public function Recette_type() {
        return $this->hasOne('recette_type'); // this matches the Eloquent model
    }
}
