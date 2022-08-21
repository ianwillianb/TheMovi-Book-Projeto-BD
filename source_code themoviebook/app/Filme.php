<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Filme extends Model
{
    protected $fillable = ['id', 'likeoudislike'];

    public $timestamps = true;

    public function user()
    {
        return $this->belongsToMany('App\User', 'curtefilme', 'filme_id', 'user_id')
            ->withPivot('likeoudislike', 'review');
    }
}
