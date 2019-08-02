@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
            
                <div class="card-header">Upcoming Matches</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ route('prediction.store') }}" method="post">
                        @csrf

                        @foreach($matches as $match)
                        <div class="row py-2">
                            <div class="col-4 mx-auto">
                                <img src="{{ $match->homeEmblem }}" alt="{{ $match->homeTeam }}">
                            </div>
                            <div class="form-group col-4 my-auto mx-auto">
                                <input class="col-5" name="home{{ $match->id }}"></input>
                                <input class="col-5" name="away{{ $match->id }}"></input>
                            </div>
                            <div class="col-4 mx-auto">
                                <img src="{{ $match->awayEmblem }}" alt="{{ $match->awayTeam }}">
                            </div>
                        </div>
                        @endforeach
                        <button class="btn btn-lg btn-primary mx-auto" type="submit">Submit</button>
                        </form>
                    </div>
                </div>
        </div>

        <div class="col-md-7">
            <div class="card">
                <div class="card-header">League Table</div>

                <div class="card-body">
                    <table class="table table-hover">
                        <tr style="text-align:center">
                            <th></th>
                            <th>Points</th>
                            <th>Correct Score</th>
                            <th>Correct Outcome</th>
                        </tr>
                        @foreach($users as $user)
                        <tr style="text-align:center">
                            <td>{{ $user->name }}</td>
                            <td>{{ ($user->correctScores * 3) + $user->correctOutcomes }}</td>
                            <td>{{ $user->correctScores }}</td>
                            <td>{{ $user->correctOutcomes }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>

        <div class="mr-0 ml-auto mt-2">
            <div class="card">
            <div class="card-header">Rules</div>

                <div class="card-body">
                    <p>Correct Score - 3pts</p>
                    <p>Wrong Score w/Correct Outcome  - 1pt</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
