@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                {{--@foreach ($friends as $friend)--}}
                {{--<div class="panel panel-default">--}}
                {{--<div class="panel-heading">{{ $friend['name'] }}</div>--}}
                {{--<div class="panel-heading">{{ explode(' ', $user['name'])[0] }}</div>--}}
                {{--<div class="panel-body">--}}
                {{--Friend--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--@endforeach--}}

                {{--@foreach ($friends2 as $friend2)--}}
                {{--<div class="panel panel-default">--}}
                {{--<div class="panel-heading">{{ $friend2['name'] }}</div>--}}
                {{--<div class="panel-heading">{{ explode(' ', $user['name'])[0] }}</div>--}}
                {{--<div class="panel-body">--}}
                {{--Friend--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--@endforeach--}}
                @foreach($friends as $friend)
                    <div class="panel panel-default">
                        <div class="panel-heading"><a href="/user/{{$friend['id']}}">{{ $friend['name'] }}</a></div>
                        {{--<div class="panel-heading">{{ explode(' ', $user['name'])[0] }}</div>--}}
                        <div class="panel-body">
                            {{--@if (($self->friendedTo->contains($user)) || ($self->friendedFrom->contains($user)))--}}
                            @if(($friend->estado == 0))
                                @if(Auth::User()->id == $friend['pivot']['id_1'])
                                    <form style="float:right;" method="POST" action="/removeFriend">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="removefriend" value="{{ $friend->id }}">
                                        <button style="float:right;" type="submit">Cancel Request</button>
                                    </form>
                                @elseif(Auth::User()->id == $friend['pivot']['id_2'])
                                    <form method="POST" action="/acceptFriend">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="user" value="{{ $friend['pivot']['relation_id'] }}">
                                        <button style="float: right;" type="submit">Accept Friend</button>
                                        {{--@php dd($friend); @endphp--}}
                                    </form>
                                    <form method="POST" action="/removeFriend">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="removefriend" value="{{ $friend->id }}">
                                        {{--@php dd($friend); @endphp--}}
                                        <button style="float: right;" type="submit">Ignore Request</button>
                                    </form>
                                @endif
                            @elseif($friend->estado == 1)
                                <p style="float:right">Friend</p>
                                <form style="float:right;" method="POST" action="/removeFriend">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="removefriend" value="{{ $friend->id }}">
                                    <button style="float:right;" type="submit">Remove</button>
                                </form>
                            @elseif($friend->estado == 2)
                                @if(Auth::User()->id == $friend['pivot']['id_1'])
                                @elseif(Auth::User()->id == $friend['pivot']['id_2'])
                                    <form method="POST" action="/addFriend">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="user" value="{{ $friend->id }}">
                                        <button style="float: right;" type="submit">Add Friend</button>
                                    </form>
                                @endif
                            @elseif($friend->estado == 3)
                                <p>Bloqueado</p>
                            @endif
                        </div>
                    </div>
                @endforeach
                @foreach ($users as $user)
                    <div class="panel panel-default">
                        <div class="panel-heading"><a href="/user/{{ $user['id'] }}">{{ $user['name'] }}</a></div>
                        {{--<div class="panel-heading">{{ explode(' ', $user['name'])[0] }}</div>--}}
                        <div class="panel-body">
                            {{--@if (($self->friendedTo->contains($user)) || ($self->friendedFrom->contains($user)))--}}
                                <form method="POST" action="/addFriend">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="user" value="{{ $user['id'] }}">
                                    <button style="float: right;" type="submit">Add Friend</button>
                                </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
