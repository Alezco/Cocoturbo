<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = array('menu_title', 'user_id', 'entree_id', 'plat_id', 'dessert_id');

    public function entree(){
        return $this->hasOne('App\Recette', 'id', 'entree_id');
    }
    public function plat(){
        return $this->hasOne('App\Recette', 'id', 'plat_id');
    }
    public function dessert(){
        return $this->hasOne('App\Recette', 'id', 'dessert_id');
    }
}
