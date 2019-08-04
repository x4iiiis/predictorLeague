@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        

        <div class="col-md-7">
            <div class="card">
                <div class="card-header">League Table</div>

                <div class="card-body">
                    <table class="table table-hover" id="leagueTable">
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

        <div class="mr-0 ml-auto my-2">
            <div class="card">
            <div class="card-header">Rules</div>

                <div class="card-body">
                    <p>Correct Score - 3pts</p>
                    <p>Wrong Score w/Correct Outcome  - 1pt</p>
                </div>
            </div>
        </div>
    </div>




    <div class="col-md-5 mb-2">
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

                        @isset($matches)
                            @if(sizeof($matches) == 0)
                                @foreach($matches as $match)
                                <div class="row py-2">
                                    <div class="col-3 mx-auto">
                                        <img src="{{ $match->homeEmblem }}" alt="{{ $match->homeTeam }}">
                                    </div>
                                    <div class="form-group col-6 my-auto mx-auto">
                                        <input class="col-5" name="home{{ $match->id }}"></input>
                                        <input class="col-5" name="away{{ $match->id }}"></input>
                                    </div>
                                    <div class="col-3 mx-auto">
                                        <img src="{{ $match->awayEmblem }}" alt="{{ $match->awayTeam }}">
                                    </div>
                                </div>
                                @endforeach
                                <button class="btn btn-lg btn-primary mx-auto" type="submit">Submit</button>
                            @endif
                        @endisset
                        </form>
                    </div>
                </div>

                <div class="card mt-5">
            
                <div class="card-header">Previous Matches</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @isset($prevMatches)
                            @if(sizeof($prevMatches) != 0)
                                @foreach($prevMatches as $prevMatch)

                                <div class="row py-2">
                                    <div class="col-3 mx-auto">
                                        <img src="{{ $prevMatch->homeEmblem }}" alt="{{ $prevMatch->homeTeam }}">
                                    </div>
                                    <div class="col-6 mx-auto my-auto text-center">
                                        <h1 style="display: inline;">{{ $prevMatch->homegoals }} - </h1>
                                        <h1 style="display: inline;">{{ $prevMatch->awayGoals }}</h1>
                                    </div>
                                    <div class="col-3 mx-auto">
                                        <img src="{{ $prevMatch->awayEmblem }}" alt="{{ $prevMatch->awayTeam }}">
                                    </div>
                                </div>
                                @endforeach
                            @endif
                        @endisset
                    </div>
                </div>
        </div>
</div>
</div>

<script>
//function sortTable() {
  var table, rows, switching, i, x, y, shouldSwitch;
  table = document.getElementById("leagueTable");
  switching = true;
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("td")[1];
      y = rows[i + 1].getElementsByTagName("td")[1];
      //check if the two rows should switch place:
      if (parseInt(x.innerHTML) < parseInt(y.innerHTML)) {
        //if so, mark as a switch and break the loop:
        shouldSwitch = true;
        break;
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
    }
  }
//}
</script>
@endsection
