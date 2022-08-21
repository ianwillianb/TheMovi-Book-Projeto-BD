<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class SearchController extends Controller
{


    public function searchMovies(Request $request)
    {

        $this->validate($request, [
            'name' => 'required_without_all:ano',
            'ano' => 'required_without_all:name',
        ]);

        $token = new \Tmdb\ApiToken(env('TMDB_API_KEY'), ['secure' => false]);
        $client = new \Tmdb\Client($token);

        $searchFilters['language'] = 'pt-br';

        if (request('flag') == '1') {

            $title = request('name');
            $searchFilters['language'] = 'pt-br';

            if (empty(request('name'))) {
                $year = request('ano');
                $result = $client->getDiscoverApi()->discoverMovies([
                    'page' => 1,
                    'language' => 'pt-br',
                    'primary_release_year' => $year,
                    'sort_by' => 'popularity.desc',
                    'include_adult' => 'false',
                    'include_video' => 'false'
                ]);
            } else {
                if (!empty(request('ano'))) {
                    $searchFilters['year'] = request('ano');

                }
                $result = $client->getSearchApi()->searchMovies($title, $searchFilters);
            }
            $movies = $result['results'];

            return view('listmovie')->with('movies', $movies);
        } else if (request('flag') == '0') {

            $this->validate($request, [
                'name' => 'required',
            ]);

            $title = request('name');
            $searchFilters['language'] = 'pt-br';

            if (!empty(request('ano'))) {
                $searchFilters['year'] = request('ano');
            }

            $result = $client->getSearchApi()->searchMulti($title, $searchFilters);
            $results = $result['results'];

            return view('listeverything')->with('results', $results);

        } else if (request('flag') == '2') {
            $title = request('name');
            $searchFilters['language'] = 'pt-br';

            if (empty(request('name'))) {
                $year = request('ano');
                $result = $client->getDiscoverApi()->discoverTv([
                    'page' => 1,
                    'language' => 'pt-br',
                    'primary_air_date_year' => $year,
                    'sort_by' => 'popularity.desc',
                    'include_adult' => 'false',
                    'include_video' => 'false'
                ]);

            } else {
                if (!empty(request('ano'))) {
                    $searchFilters['primary_air_date_year'] = request('ano');
                }
                $result = $client->getSearchApi()->searchTv($title, $searchFilters);
            }
            $seriess = $result['results'];

            return view('listTv')->with('seriess', $seriess);
        } else if (request('flag') == '3') {
            $this->validate($request, [
                'name' => 'required',
            ]);

            $title = request('name');
            $searchFilters['language'] = 'pt-br';

            if (!empty(request('ano'))) {
                $searchFilters['year'] = request('ano');
            }

            $result = $client->getSearchApi()->searchPersons($title);
            $persons = $result['results'];

            return view('listperson')->with('persons', $persons);
        }
    }


    public function searchUserResults($userToSearch, $friends)
    {
        $users = User::where('name', 'LIKE', "%$userToSearch%")->where('id', '<>', Auth::User()->id)->orderBy('name');
        $friends = $friends->toArray();
        $friendsId = array();
        foreach ($friends as $friend) {
            $friendsId[] = $friend['id'];
        }
        $users = $users->whereNotIn('id', $friendsId)->get();
        return $users;
    }

    public function searchFriendsResults($userToSearch)
    {
        $user1 = Auth::user()->friendedTo()->select('*')->where('name', 'LIKE', "%$userToSearch")->orderBy('name')->get();
        $user2 = Auth::user()->friendedFrom()->select('*')->where('name', 'LIKE', "%$userToSearch")->orderBy('name')->get();
        $friends = $user1->merge($user2)->sortBy('name');
        return $friends;
    }

    public function searchUser(Request $request)
    {
        $userToSearch = $request->get('user');
        $friends = $this->searchFriendsResults($userToSearch);
        $users = $this->searchUserResults($userToSearch, $friends);
        //dd($users);
        return view('usersearch')->with('users', $users)->with('friends', $friends);
    }
}

/*SELECT B.name "Friend's Name"
FROM
(
    SELECT userid FROM friends WHERE friendid=@givenuserid
    UNION
    SELECT friendid FROM friends WHERE userid=@givenuserid
) A INNER JOIN user B USING (userid);*/