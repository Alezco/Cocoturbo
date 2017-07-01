<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recette extends Model
{
    protected $fillable = array('recettes_name', 'created_at', 'updated_at');

    public function Recette_type() {
        return $this->hasOne('Recette_type'); // this matches the Eloquent model
    }
}
