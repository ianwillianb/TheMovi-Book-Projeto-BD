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
                                     src="https://image.tmdb.org/t/p/w500{{ $movie['backdrop_path'] }}" alt="">
                            </h1>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <h1>{{ $movie['original_title'] }}</h1>
                                    <p>{{ $movie['overview'] }}</p>
                                    <p>Lançado em: {{ $movie['release_date'] }}</p>

                                    <p>{{ $curtiramCount }} pessoas curtiram esse filme <br>
                                        {{ $naoCurtiramCount }} pessoas não curtiram esse filme</p>
                                    <br>

                                    <img style="width:20%; height:20%;"
                                         src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}" alt="">
                                    @if ($user)
                                        @if ($user->pivot->likeoudislike)
                                            <p style="float:right;">
                                                Voce curte esse filme
                                                <br>
                                            <form method="POST" action="/desfazerFilme">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="user" value="{{ $movie['id'] }}">
                                                <button id="curtir" style="float: right;" type="submit">Desfazer
                                                </button>
                                                {{--@php dd($friend); @endphp--}}
                                            </form>
                                            </p>


                                            <form method="POST" action="/avaliarFilme">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="user" value="{{ $movie['id'] }}">
                                                <div class="form-group">
                                                    <label for="comment">Comentário:</label>
                                                    <textarea class="form-control" rows="2" id="comment"
                                                              name="review"></textarea>
                                                    <button class="" style="float: right;" name="user" type="submit">
                                                        Comentar
                                                    </button>
                                                </div>
                                                {{--@php dd($friend); @endphp--}}
                                            </form>
                                        @else
                                            <p style="float:right;">Voce não curtiu esse filme</p>
                                            <br>
                                            <form method="POST" action="/desfazerFilme">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="user" value="{{ $movie['id'] }}">
                                                <button id="curtir" style="float: right;" type="submit">Desfazer
                                                </button>
                                                {{--@php dd($friend); @endphp--}}
                                            </form>
                                            <form method="POST" action="/avaliarFilme">
                                                {{ csrf_field() }}
                                                <div class="form-group">
                                                    <label for="comment">Comentário:</label>
                                                    <textarea class="form-control" rows="2" id="comment"
                                                              name="review"></textarea>
                                                </div>

                                                <input type="hidden" name="user" value="{{ $movie['id'] }}">
                                                <button class="" style="float: right;" type="submit">Comentar</button>
                                                {{--@php dd($friend); @endphp--}}
                                            </form>
                                        @endif
                                    @else
                                        <form method="POST" action="/naoCurtirFilme">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="user" value="{{ $movie['id'] }}">
                                            <input type="hidden" name="nome" value="{{ $movie['original_title'] }}">
                                            <input type="hidden" name="poster_path" value="{{ $movie['poster_path'] }}">
                                            <button style="float: right;" type="submit">Eu não curto esse filme</button>
                                            {{--@php dd($friend); @endphp--}}
                                        </form>
                                        <form method="POST" action="/curtirFilme">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="user" value="{{ $movie['id'] }}">
                                            <input type="hidden" name="nome" value="{{ $movie['original_title'] }}">
                                            <input type="hidden" name="poster_path" value="{{ $movie['poster_path'] }}">
                                            <button id="curtir" style="float: right;" type="submit">Eu curto esse
                                                filme
                                            </button>
                                            {{--@php dd($friend); @endphp--}}
                                        </form>
                                    @endif
                                </table>
                            </div>
                            @if($users)
                                {{--@php dd($users) @endphp--}}
                                <h3>Comentários</h3>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            @foreach($users as $review)
                                                @if($review->pivot->review)
                                                    <p><h4>{{ $review->pivot->review }}</h4>
                                                    <strong>Por {{ $review->name }}</strong></p>


                                                    @if(($review->pivot->review) && $review->id == Auth::user()->id)
                                                        <form method="POST" action="/deletarComentarioFilme">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="delete" value="{{ $movie['id'] }}">
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
    </div>
    </div>


@endsection
