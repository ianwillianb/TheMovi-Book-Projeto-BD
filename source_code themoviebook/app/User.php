<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class User extends Authenticatable
{

    public $timestamps = true;

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * Relações User -> User     0=pendente, 1=aceito, 2=recusado, 3=bloqueado
     */


    public function friendedTo()
    {
        return $this->belongsToMany('App\User', 'relacao', 'id_1', 'id_2')
            ->withPivot('estado', 'relation_id');
    }


    public function friendedFrom()
    {
        return $this->belongsToMany('App\User', 'relacao', 'id_2', 'id_1')
            ->withPivot('estado', 'relation_id');
    }

    public function getFriendsAttribute()
    {
        if (!array_key_exists('friends', $this->relations)) $this->loadFriends();

        return $this->getRelation('friends');
    }

    protected function loadFriends()
    {
        if (!array_key_exists('friends', $this->relations)) {
            $friends = $this->mergeFriends();

            $this->setRelation('friends', $friends);
        }
    }

    protected function mergeFriends()
    {
        return $this->friendedFrom->merge($this->friendedTo);
    }

    public function getIsFriendAttribute()
    {
        $isfriend = $this->friends->find(Auth::user()->id);
        if ($isfriend) {
            return $isfriend->count();
        }
        return 0;
    }

    public function filme()
    {
        return $this->belongsToMany('App\Filme', 'curtefilme', 'user_id', 'filme_id')
            ->withPivot('likeoudislike');
    }

    public function serie()
    {
        return $this->belongsToMany('App\Serie', 'curteserie', 'user_id', 'serie_id')
            ->withPivot('likeoudislike', 'review');
    }
}

/*// access all friends
$user->friends; // collection of unique User model instances

// access friends a user invited
$user->friendedTo; // collection

// access friends that a user was invited by
$user->friendFrom; // collection

// and eager load all friends with 2 queries
$usersWithFriends = User::with('friendedTo', 'friendedFrom')->get();

// then
$users->first()->friends; // collection

// Check the accepted value:
$user->friends->first()->pivot->accepted;*/
