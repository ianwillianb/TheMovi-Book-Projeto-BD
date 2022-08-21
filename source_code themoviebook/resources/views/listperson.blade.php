@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @forelse ($persons as $person)
                    <div class="panel panel-default">
                        <div class="panel-heading">{{ $person['name'] }}</div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <p>Conhecido por:
                                        @foreach ($person['known_for'] as $known)
                                            {{ $known['title'] }},
                                        @endforeach
                                    </p>
                                    <img style="width:20%; height:20%;"
                                         src="https://image.tmdb.org/t/p/w500{{ $person['profile_path'] }}" alt="">
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

