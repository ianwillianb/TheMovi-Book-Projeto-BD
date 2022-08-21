<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use \App\Serie;

class SerieController extends Controller
{
    public function profile($id)
    {
        $token = new \Tmdb\ApiToken(env('TMDB_API_KEY'), ['secure' => false]);
        $client = new \Tmdb\Client($token);

        $series = $client->getTvApi()->getTvshow($id);


        $user = Auth::user();
        $user = $user->serie()->whereserie_id($id)->first();

        $serie = \App\Serie::find($id);
        if($serie) {
            $users = $serie->user();
            $curtiramCount = $users->wherePivot('likeoudislike', 1)->count();
            $naoCurtiramCount = \App\Serie::where('id', $id)->first()->user()->wherePivot('likeoudislike', 0)->count();
            $users = \App\Serie::where('id', $id)->first()->user()->get();
        } else {
            $users = NULL;
            $curtiramCount = 0;
            $naoCurtiramCount = 0;
        }
        return view('serie')->with('series', $series)
            ->with('user', $user)
            ->with('users', $users)
            ->with('curtiramCount', $curtiramCount)
            ->with('naoCurtiramCount', $naoCurtiramCount);
    }


    public function saveSerie($id, $nome, $poster_path)
    {
        $serie = new Serie;
        $serie->id = $id;
        $serie->nome = $nome;
        $serie->poster_path = $poster_path;
        $serie->save();
        return;
    }


    public function curtirSerie(Request $request)
    {
        $user_id = Auth::user()->id;
        $id = $request->get('user');
        $nome = $request->get('nome');
        $poster_path = $request->get('poster_path');
        $serie = \App\Serie::find($id);
        if(!$serie)
        {
            $this->saveSerie($id, $nome, $poster_path);
        }
        $serie = \App\Serie::find($id);
        $serie->user()->attach($user_id, ['likeoudislike' => 1]);

        return back();
    }


    public function naoCurtirSerie(Request $request)
    {
        $user_id = Auth::user()->id;
        $id = $request->get('user');
        $nome = $request->get('nome');
        $poster_path = $request->get('poster_path');
        $serie = \App\Serie::find($id);
        if(!$serie)
        {
            $this->saveSerie($id, $nome, $poster_path);
        }
        $serie = \App\Serie::find($id);
        $serie->user()->attach($user_id, ['likeoudislike' => 0]);

        return back();
    }


    public function desfazerSerie(Request $request)
    {
        $user_id = Auth::user()->id;
        $id = $request->get('user');
        $serie = \App\Serie::find($id);
        $serie->user()->detach($user_id);

        return back();
    }


    public function avaliarSerie(Request $request)
    {
        $user= Auth::user();
        $review = $request->get('review');
        $curteserie = \DB::table('curteserie')->whereserie_id($request->get('user'))->whereuser_id($user->id)->update(['review' => $review]);
        \DB::commit();
        return back()->with('review', $curteserie);
    }

    public function deletarComentario(Request $request)
    {
        $user= Auth::user();
        \DB::table('curteserie')->whereserie_id($request->get('delete'))->whereuser_id($user->id)->update(['review' => null]);
        \DB::commit();
        return back();
    }
}
