<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecetteType extends Model
{
    protected $fillable = array('type_name');

    public function Recettes(){
        return $this->belongsTo('Recettes');
    }
}
