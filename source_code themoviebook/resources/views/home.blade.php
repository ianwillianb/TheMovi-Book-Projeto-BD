@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>
                    <div class="panel-body">
                        <form method="POST" action="/search" class="form-horizontal">
                            {{ csrf_field() }}
                            <div class="panel-body">
                                <div class="form-group">
                                    <select class="form-control" name="flag">
                                        {{--<option value="0">Search Everything</option>--}}
                                        <option value="1" selected>Search Movies</option>
                                        <option value="2">Search TV Shows</option>
                                        <option value="3">Search People</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="movie">Name:</label>
                                    <input type="text" class="form-control" placeholder="Name" id="name"
                                           name="name"/>
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="ano">Ano:</label>
                                    <input type="text" class="form-control" placeholder="Year" id="ano"
                                           name="ano"/>
                                </div>
                                <button style="float:right" type="submit" class="btn btn-primary"><span
                                            class="glyphicon glyphicon-search"
                                            aria-hidden="true"></span></button>
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                            {{ $error }}
                                        @endforeach
                                    </div>
                                @endif
                            </div>


                        </form>
                    </div>
                    <hr>
                    <div class="panel-body">
                        <p><h3>Os filmes mais populares:</h3></p>
                        @foreach($topFilmes as $topFilme)
                            <a href="/filme/{{ $topFilme['id'] }}">
                                <img style="width:19%; height:19%;" src="https://image.tmdb.org/t/p/w500{{ $topFilme['poster_path'] }}" alt="">
                            </a>
                        @endforeach
                    </div>
                    <hr>
                    <div class="panel-body">
                        <p><h3>As séries mais populares:</h3></p>
                        @foreach($topSeries as $topSerie)
                            <a href="/serie/{{ $topSerie['id'] }}">
                                <img style="width:19%; height:19%;" src="https://image.tmdb.org/t/p/w500{{ $topSerie['poster_path'] }}" alt="">
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div
    </div>


@endsection
