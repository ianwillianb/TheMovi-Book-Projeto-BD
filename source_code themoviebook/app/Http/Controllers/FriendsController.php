<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class FriendsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $friends = Auth::user()->friends;
        return view("friends")->with('friends', $friends);
    }


    public function addFriend(Request $request)
    {
        $user = Auth::user();
        $friend = User::find($request->get('user'));
        $check = \DB::table('relacao')->whereid_1($friend->id)->whereid_2($user->id);
        $check2 = \DB::table('relacao')->whereid_2($friend->id)->whereid_1($user->id);
        if(($check->exists()) > 0)
        {
            if($check->get()->first()->estado == 2) {
                $check->update(['estado' => 0]);
                //dd($check);
            }
            return back();
        }
        else if(($check2->exists()) > 0)
        {
            if($check2->get()->first()->estado == 2) {
                $check2->update(['estado' => 0]);
                //dd($check2);
            }
            return redirect()->route('home');
        }
        $user->friendedTo()->attach($friend);
        return redirect()->route('home');
    }

    public function acceptFriend(Request $request)
    {
        $id = (int)$request->get('user');
        $friend = \DB::table('relacao')->whererelation_id($id);
        //dd($friend->first());
        $friend->update(['estado' => 1]);
        return redirect()->route('home');
    }

    public function rejectFriend(Request $request)
    {
        $user = Auth::user();
        $friendR = User::find($request->get('removefriend'));
        $user->friendedFrom()->detach($friendR);
        $user->friendedTo()->detach($friendR);
        return redirect()->route('home');
    }


    public function show(Request $user)
    {
        $friends = User::has($user)->get();
        return $friends;
    }


    public function removeFriend(Request $friend)
    {
        $user = Auth::user();
        $friendR = User::find($friend->get('removefriend'));
        $user->friendedFrom()->detach($friendR);
        $user->friendedTo()->detach($friendR);

        return redirect()->route('home');
    }


    public function destroy($id)
    {

    }
}
