@extends ('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $user->name }}
                        @if ($authRelation)
                            @if($authRelation->estado == 0)
                                @if ($authRelation->id_2 == $user->id)
                                    <form style="float:right;" method="POST" action="/removeFriend">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="removefriend" value="{{ $user->id }}">
                                        <button style="float:right;" type="submit">Cancel Request</button>
                                    </form>

                                @elseif ($authRelation->id_1 == $user->id)
                                    <form method="POST" action="/acceptFriend">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="user" value="{{ $authRelation->relation_id }}">
                                        <button style="float: right;" type="submit">Accept Friend</button>
                                    </form>
                                    <form method="POST" action="/removeFriend">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="removefriend" value="{{ $user->id }}">
                                        <button style="float: right;" type="submit">Ignore Request</button>
                                    </form>
                                @endif

                            @elseif ($authRelation->estado == 1)
                                <p style="float:right;">Friend</p>
                                <form style="float:right;" method="POST" action="/removeFriend">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="removefriend" value="{{ $user->id }}">
                                    <button style="float:right;" type="submit">Remove Friend</button>
                                </form>

                            @elseif ($authRelation->estado == 2)
                                @if ($authRelation->id_2 == $user->id)
                                @elseif ($authRelation->id_1 == $user->id)
                                    <form method="POST" action="/addFriend">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="user" value="{{ $user->id }}">
                                        <button style="float: right;" type="submit">Add Friend</button>
                                    </form>
                                @endif
                            @elseif ($authRelation->estado == 3)
                            @endif
                        @elseif ($user->id == Auth::user()->id)

                        @else
                            <form method="POST" action="/addFriend">
                                {{ csrf_field() }}
                                <input type="hidden" name="user" value="{{ $user->id }}">
                                <button style="float: right;" type="submit">Add Friend</button>
                            </form>
                        @endif
                    </div>
                    <div class="panel-body">
                    </div>
                    <div class="panel-heading">Friends</div>
                    <div class="panel-body">
                        @if ($friends->isEmpty())

                            <p>O usuário não possui amigos</p>

                        @endif
                        @foreach ($friends as $friend)
                            @if($friend->pivot->estado == 1)
                                <a href="/user/{{ $friend['id'] }}">
                                    <p>{{ $friend->name }}</p>
                                </a>
                            @endif
                        @endforeach
                    </div>
                    <hr>
                    <div class="panel-body">
                        @if (!$filmesCurtidos->isEmpty())
                            <h4>Filmes curtidos</h4>
                            @foreach($filmesCurtidos as $filme)
                                @if($filme->pivot->likeoudislike)
                                    <a href="/filme/{{ $filme['id'] }}"><img style="width:19%; height:19%;" src="https://image.tmdb.org/t/p/w500{{ $filme['poster_path'] }}" alt=""></a>
                                @endif
                            @endforeach
                        @else
                            <hr>
                            <p>O usuário ainda não tem nenhum filme curtido</p>
                        @endif
                        @if(!$filmesNaoCurtidos->isEmpty())
                            <h4>Filmes não curtidos</h4>
                            @foreach($filmesNaoCurtidos as $filme)
                                @if (!$filme->pivot->likeoudislike)
                                    <a href="/filme/{{ $filme['id'] }}"><img style="width:19%; height:19%;" src="https://image.tmdb.org/t/p/w500{{ $filme['poster_path'] }}" alt=""></a>
                                @endif
                            @endforeach
                        @else
                            <hr>
                            <p>O usuário ainda não tem nenhum filme não curtido</p>
                        @endif
                    </div>
                    <hr>
                    <div class="panel-body">
                        @if(!$seriesCurtidas->isEmpty())
                            <h4>Séries curtidas</h4>
                            @foreach($seriesCurtidas as $serie)
                                @if($serie->pivot->likeoudislike)
                                    <a href="/serie/{{ $serie['id'] }}"><img style="width:19%; height:19%;" src="https://image.tmdb.org/t/p/w500{{ $serie['poster_path'] }}" alt=""></a>
                                @endif
                            @endforeach
                        @else
                            <p>O usuário ainda não tem nenhuma série curtida</p>
                        @endif
                        @if(!$seriesNaoCurtidas->isEmpty())
                            <h4>Séries não curtidas</h4>
                            @foreach($seriesNaoCurtidas as $serie)
                                @if (!$serie->pivot->likeoudislike)
                                    <a href="/serie/{{ $serie['id'] }}"><img style="width:19%; height:19%;" src="https://image.tmdb.org/t/p/w500{{ $serie['poster_path'] }}" alt=""></a>
                                @endif
                            @endforeach
                        @else
                            <hr>
                            <p>O usuário ainda não tem nenhuma série não curtida</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection