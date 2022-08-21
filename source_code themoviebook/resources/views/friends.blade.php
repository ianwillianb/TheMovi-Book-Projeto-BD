@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
                    @foreach ($friends as $friend)
                        @if ($friend->pivot->estado != 2 && $friend->pivot->estado != 3)
                            <div class="panel panel-default">
                                <div class="panel-heading">

                                        <a href="/user/{{ $friend['id'] }}">
                                            {{ $friend['name'] }}
                                        </a>
                                        @if ($friend->pivot->estado == 0)
                                            @if($friend->pivot->id_1 == $friend->id)
                                                <form method="POST" action="/acceptFriend">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="user" value="{{ $friend['pivot']['relation_id'] }}">
                                                    <button style="float: right;" type="submit">Aceitar pedido</button>
                                                </form>
                                                <form method="POST" action="/removeFriend">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="removefriend" value="{{ $friend->id }}">
                                                    <button style="float: right;" type="submit">Ignorar pedido</button>
                                                </form>
                                            @else
                                                <form style="float:right;" method="POST" action="/removeFriend">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="removefriend" value="{{ $friend->id }}">
                                                    <button style="float:right;" type="submit">Cancelar pedido</button>
                                                </form>
                                            @endif
                                        @elseif ($friend->pivot->estado == 1)
                                            <p style="float:right;">Friends</p>
                                            <form style="float:right;" method="POST" action="/removeFriend">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="removefriend" value="{{ $friend->id }}">
                                                <button style="float:right;" type="submit">Remover Amigo</button>
                                            </form>
                                        @endif
                                </div>
                                <div class="panel-body">
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
