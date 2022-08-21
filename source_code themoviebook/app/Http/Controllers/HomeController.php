<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Filme;
use \App\Serie;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */



    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function topFilmes()
    {
        $searchFilters['language'] = 'pt-br';
        $tops = Filme::withCount('user')
            ->orderby('user_count', 'desc')
            ->take(5)
            ->get();

        $filmes = collect();
        foreach ($tops as $top) {
            $token = new \Tmdb\ApiToken(env('TMDB_API_KEY'), ['secure' => false]);
            $client = new \Tmdb\Client($token);

            $result = $client->getMoviesApi()->getMovie($top['id'], $searchFilters);
            $filmes->push($result);
        }
        return $filmes;
    }

    public function topSeries()
    {
        $searchFilters['language'] = 'pt-br';
        $tops = Serie::withCount('user')
            ->orderby('user_count', 'desc')
            ->take(5)
            ->get();

        $series = collect();
        foreach ($tops as $top) {
            $token = new \Tmdb\ApiToken(env('TMDB_API_KEY'), ['secure' => false]);
            $client = new \Tmdb\Client($token);

            $result = $client->getTvApi()->getTvshow($top['id'], $searchFilters);
            $series->push($result);
        }
        return $series;
    }

    public function index()
    {

        return view('home')->with('topFilmes', $this->topFilmes())->with('topSeries', $this->topSeries());
    }

    public function emptySearch()
    {

        return view('home')->with('$error');
    }
}
