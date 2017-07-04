<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = array('comment_content', 'user_id', 'recette_id', 'created_at', 'updated_at');

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function recette()
    {
        return $this->belongsTo('App\Recette');
    }
}
