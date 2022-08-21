<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\User;
Use App\Http\Controllers\SearchController;
Use Auth;

class UsersController extends Controller
{
    public function profile($id)
    {

        $user = User::where('id', $id)->first();
        $friends = $user->friends->sortBy('name');
        $collection = collect();
        foreach($friends as $friend)
        {
            if($friend->pivot->estado == 1)
            {
                $collection->push($friend);
            }
        }
        $self = Auth::user()->id;
        $authRelation = $friends->where('id', $self);
        $filmesCurtidos = $user->filme()->wherePivot('likeoudislike',1)->get();
        $filmesNaoCurtidos = $user->filme()->wherePivot('likeoudislike', 0)->get();
        $seriesCurtidas = $user->serie()->wherePivot('likeoudislike', 1)->get();
        $seriesNaoCurtidas = $user->serie()->wherePivot('likeoudislike', 0)->get();
        //return $filmes->first();

        if ($authRelation->isEmpty())
        {

            $authRelation = false;

        }
        else
        {

            $authRelation = $authRelation->first()->pivot;

        }
            return view('/profile')
                ->with('user', $user)
                ->with('friends', $collection)
                ->with('authRelation', $authRelation)
                ->with('filmesCurtidos', $filmesCurtidos)
                ->with('filmesNaoCurtidos', $filmesNaoCurtidos)
                ->with('seriesCurtidas', $seriesCurtidas)
                ->with('seriesNaoCurtidas', $seriesNaoCurtidas);
        }
}
