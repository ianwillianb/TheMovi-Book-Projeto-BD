<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{

    public $timestamps = true;

    public function user(){
        return $this->belongsToMany('\App\User', 'curteserie', 'serie_id', 'user_id')
            ->withPivot('likeoudislike', 'review');
    }
}
