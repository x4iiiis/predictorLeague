@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        

        <div class="col-md-7">
            <!-- League Table Vue Component -->
            <League-Table></League-Table>
            <!-- Rules Vue Component -->
            <Rules></Rules>
        </div>


        <div class="col-md-5 mb-2">
            <!-- Fixtures Vue Component --> 
            <Fixtures></Fixtures>
            <!-- Results Vue Component -->
            <Results></Results>
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
