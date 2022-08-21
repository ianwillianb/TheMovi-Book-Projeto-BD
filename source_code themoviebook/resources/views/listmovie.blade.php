@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @forelse ($movies as $movie)
                    <div class="panel panel-default">
                        <div class="panel-heading"><a href="/filme/{{ $movie['id'] }}">{{ $movie['title'] }}</a></div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <p>{{ $movie['overview'] }}</p>
                                    <p>Lançado em: {{ $movie['release_date'] }}</p>
                                    <img style="width:20%; height:20%;"
                                         src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}" alt="">
                                    <a href="/filme/{{ $movie['id'] }}"><h4>Ver mais detalhes</h4></a>
                                </table>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="panel panel-default">
                        <div class="panel-heading">Erro</div>
                        <div class="panel-body">
                            Não encontrado
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection