<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = array('comment_content', 'created_at', 'updated_at');

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function recette()
    {
        return $this->belongsTo('App\Recette');
    }
}
