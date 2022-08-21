<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Filme;

class FilmeController extends Controller
{

    public function profile($id)
    {
        $searchFilters['language'] = 'pt-br';
        $token = new \Tmdb\ApiToken(env('TMDB_API_KEY'), ['secure' => false]);
        $client = new \Tmdb\Client($token);

        $movie = $client->getMoviesApi()->getMovie($id, $searchFilters);


        $user = Auth::user();
        $user = $user->filme()->wherefilme_id($id)->first();


        $filme = \App\Filme::where('id', $id)->first();
        if($filme) {
            $users = $filme->user();
            //return $users->first();
            $curtiramCount = $users->wherePivot('likeoudislike', 1)->count();
            $naoCurtiramCount = \App\Filme::where('id', $id)->first()->user()->wherePivot('likeoudislike', 0)->count();
            $users = \App\Filme::where('id', $id)->first()->user()->get();
        } else {
            $users = null;
            $curtiramCount = 0;
            $naoCurtiramCount = 0;
        }
        return view('filme')->with('movie', $movie)
            ->with('user', $user)
            ->with('users', $users)
            ->with('curtiramCount', $curtiramCount)
            ->with('naoCurtiramCount', $naoCurtiramCount);


    }


    public function saveMovie($id, $nome, $poster_path)
    {
        $filme = new Filme;
        $filme->id = $id;
        $filme->nome = $nome;
        $filme->poster_path = $poster_path;
        $filme->save();
        return;
    }


    public function curtirFilme(Request $request)
    {
        $user_id = Auth::user()->id;
        $id = $request->get('user');
        $nome = $request->get('nome');
        $poster_path = $request->get('poster_path');
        $filme = \App\Filme::find($id);
        if(!$filme)
        {
            $this->saveMovie($id, $nome, $poster_path);
        }
        $filme = \App\Filme::find($id);
        $filme->user()->attach($user_id, ['likeoudislike' => 1]);

        return back();
    }


    public function naoCurtirFilme(Request $request)
    {
        $user_id = Auth::user()->id;
        $id = $request->get('user');
        $nome = $request->get('nome');
        $poster_path = $request->get('poster_path');
        $filme = \App\Filme::find($id);
        if(!$filme)
        {
            $this->saveMovie($id, $nome, $poster_path);
        }
        $filme = \App\Filme::find($id);
        $filme->user()->attach($user_id, ['likeoudislike' => 0]);

        return back();
    }


    public function desfazerFilme(Request $request)
    {
        $user_id = Auth::user()->id;
        $id = $request->get('user');
        $filme = \App\Filme::find($id);
        $filme->user()->detach($user_id);

        return back();
    }


    public function avaliarFilme(Request $request)
    {
        $user= Auth::user();
        $filme = $user->filme()->wherefilme_id($request->get('user'))->first();
        $review = $request->get('review');
        $curtefilme = \DB::table('curtefilme')->wherefilme_id($request->get('user'))->whereuser_id($user->id)->update(['review' => $review]);
        \DB::commit();
        return back()->with('review', $curtefilme);
    }

    public function deletarComentario(Request $request)
    {
        $user= Auth::user();
        //\DB::table('curtefilme')->wherefilme_id($request->get('delete'))->whereuser_id($user->id)->update(['review' => null]);
        //\DB::commit();
        $user = $user->filme()->find($request->get('delete'));
        $user->pivot->review = null;
        $user->pivot->save();

        return back();
    }
}
