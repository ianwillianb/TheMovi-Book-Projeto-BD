@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h1>
                                <img style="object-fit: cover; width:100%"
                                     src="https://image.tmdb.org/t/p/w500{{ $series['backdrop_path'] }}" alt="">
                            </h1>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <h1>{{ $series['original_name'] }}</h1>
                                    <p>{{ $series['overview'] }}</p>
                                    <p>Data do primeiro episódio: {{ $series['first_air_date'] }}</p>

                                    <p>{{ $curtiramCount }} pessoas curtiram essa série <br>
                                        {{ $naoCurtiramCount }} pessoas não curtiram essa série</p>
                                    <br>

                                    <img style="width:20%; height:20%;"
                                         src="https://image.tmdb.org/t/p/w500{{ $series['poster_path'] }}" alt="">
                                    @if ($user)
                                        @if ($user->pivot->likeoudislike)
                                            <p style="float:right;">Voce curte essa série
                                            <form method="POST" action="/desfazerSerie">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="user" value="{{ $series['id'] }}">
                                                <button id="curtir" style="float: right;" type="submit">Desfazer
                                                </button>
                                                {{--@php dd($friend); @endphp--}}
                                            </form>
                                            </p>
                                            <br>

                                            <form method="POST" action="/avaliarSerie">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="user" value="{{ $series['id'] }}">
                                                <div class="form-group">
                                                    <label for="comment">Comentário:</label>
                                                    <textarea class="form-control" rows="2" name="review"></textarea>
                                                    <button class="" style="float: right;" name="user" type="submit">Comentar</button>
                                                </div>
                                            </form>
                                        @else
                                            <p style="float:right;">Voce não curtiu essa série</p>
                                            <br>
                                            <form method="POST" action="/desfazerSerie">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="user" value="{{ $series['id'] }}">
                                                <button id="curtir" style="float: right;" type="submit">Desfazer
                                                </button>
                                            </form>
                                            <form method="POST" action="/avaliarSerie">
                                                {{ csrf_field() }}
                                                <div class="form-group">
                                                    <label for="comment">Comentário:</label>
                                                    <textarea class="form-control" rows="2" name="review"></textarea>
                                                </div>
                                                <input type="hidden" name="user" value="{{ $series['id'] }}">
                                                <button class="" style="float: right;" type="submit">Comentar</button>
                                                {{--@php dd($friend); @endphp--}}
                                            </form>
                                        @endif
                                    @else
                                        <form method="POST" action="/naoCurtirSerie">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="user" value="{{ $series['id'] }}">
                                            <input type="hidden" name="nome" value="{{ $series['original_name'] }}">
                                            <input type="hidden" name="poster_path" value="{{ $series['poster_path'] }}">
                                            <button style="float: right;" type="submit">Eu não curto essa série</button>
                                            {{--@php dd($friend); @endphp--}}
                                        </form>
                                        <form method="POST" action="/curtirSerie">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="user" value="{{ $series['id'] }}">
                                            <input type="hidden" name="nome" value="{{ $series['original_name'] }}">
                                            <input type="hidden" name="poster_path" value="{{ $series['poster_path'] }}">
                                            <button id="curtir" style="float: right;" type="submit">Eu curto essa série</button>
                                            {{--@php dd($friend); @endphp--}}
                                        </form>
                                    @endif
                                </table>
                            </div>
                            @if($users)
                                <h3>Comentários</h3>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            @foreach($users as $review)
                                                {{--@php dd($review->review) @endphp--}}
                                                @if($review->pivot->review)
                                                    <p><h4>{{ $review->pivot->review }}</h4>
                                                    <strong>Por {{ $review->name }}</strong></p>


                                                    @if(($review->pivot->review) && $review->id == Auth::user()->id)
                                                        <form method="POST" action="/deletarComentarioSerie">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="delete" value="{{ $series['id'] }}">
                                                            <button id="curtir" style="float: right;" type="submit">Excluir comentario</button>
                                                            <br>
                                                            {{--@php dd($friend); @endphp--}}
                                                        </form>
                                                    @endif
                                                    <hr>
                                                @endif
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div
    </div>


@endsection
