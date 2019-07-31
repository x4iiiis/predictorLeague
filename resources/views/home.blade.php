@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">Upcoming Matches</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="row py-2">
                            <div class="col-4 mx-auto">
                                <img src="img/clubEmblems/Hibernian.png">
                            </div>
                            <div class="form-group col-4 my-auto mx-auto">
                                <input class="col-5"></input>
                                <input class="col-5"></input>
                            </div>
                            <div class="col-4 mx-auto">
                                <img src="img/clubEmblems/HeartOfMidlothian.png">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="text-center">
                        <div class="btn btn-lg btn-primary mx-auto">Submit</div>
                    </div>
                </div>
        </div>

        <div class="col-md-5">
            <table>
                <tr style="text-align:center">
                    <th>User</th>
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

        <div class="col-md-5 mr-0 ml-auto">
            <div class="card">
            <div class="card-header">Rules</div>

                <div class="card-body">
                    <p>Correct Score - 3pts</p>
                    <p>Wrong Score w/Correct Outcome  - 1pt</p>
                    <p>Failure to submit will result in every game being predicted as 0-0</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
