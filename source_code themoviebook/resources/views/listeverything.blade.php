@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @forelse ($results as $result)
                    <div class="panel panel-default">
                        <div class="panel-heading">{{ $result['media_type'] }}</div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table">
                                    @if ($result['media_type'] == 'tv')
                                        <h3>{{ $result['name'] }}</h3>
                                        <p>Overview: {{ $result['overview'] }}</p>
                                        <p>First air date: {{ $result['first_air_date'] }}</p>
                                        <img style="width:20%; height:20%;"
                                             src="https://image.tmdb.org/t/p/w500{{ $result['poster_path'] }}"
                                             alt="">
                                    @endif

                                    @if ($result['media_type'] == 'movie')
                                        <h3>{{ $result['title'] }}</h3>
                                        <p>{{ $result['overview'] }}</p>
                                        <p>Lançado em: {{ $result['release_date'] }}</p>
                                        @if (!empty($result['poster_path']))
                                            <img style="width:20%; height:20%;"
                                                 src="https://image.tmdb.org/t/p/w500{{ $result['poster_path'] }}"
                                                 alt="">
                                        @endif
                                    @endif

                                    @if ($result['media_type'] == 'person')
                                        <h3>{{ $result['name'] }}</h3>
                                        <p>Known for:
                                            @php
                                                $knowns = $result['known_for'];
                                                foreach($knowns as $known)
                                                {
                                                    echo $known['title']. ", ";
                                                }
                                            @endphp
                                        </p>
                                        @if (!empty($result['profile_path']))
                                            <img style="width:20%; height:20%;"
                                                 src="https://image.tmdb.org/t/p/w500{{ $result['profile_path'] }}"
                                                 alt="">
                                        @endif
                                    @endif
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