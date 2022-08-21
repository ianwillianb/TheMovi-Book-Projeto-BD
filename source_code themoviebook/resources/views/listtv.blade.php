@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @forelse ($seriess as $series)
                    <div class="panel panel-default">
                        <div class="panel-heading">{{ $series['name'] }}</div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <p>{{ $series['overview'] }}</p>
                                    <p>Lançado em: {{ $series['first_air_date'] }}</p>
                                    <img style="width:20%; height:20%;"
                                         src="https://image.tmdb.org/t/p/w500{{ $series['poster_path'] }}" alt="">
                                        <a href="/serie/{{ $series['id'] }}"><h4>Ver mais detalhes</h4></a>
                                </table>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="panel panel-default">
                        <div class="panel-heading">Otaku ceboso</div>
                        <div class="panel-body">
                            Esse filme de merda nao existe seu otario poe
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection