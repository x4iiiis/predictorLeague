<template>
    <div v-if="ready" class="card my-2">
        
        <div class="card-header">League Table</div>

        <div class="card-body">
            <table class="table table-hover" id="leagueTable">
                <tr style="text-align:center">
                    <th></th>
                    <th>Points</th>
                    <th>Correct Score</th>
                    <th>Correct Outcome</th>
                </tr>
                <!-- @foreach($users as $user) --> 
                <tr v-for="user in users" style="text-align:center">
                    <td>{{ user.name }}</td>
                    <td>{{ (user.correctScores * 3) + user.correctOutcomes }}</td> 
                    <td>{{ user.correctScores }}</td>
                    <td>{{ user.correctOutcomes }}</td>
                </tr>
                <!--  @endforeach -->
            </table>
        </div>
    </div>
</template>

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

<script>
    export default {
        mounted() {
            console.log('League Table Component mounted.')
            this.updateTable()
            this.getUsers()
        },
        data() {
            return {
                users: [],
                ready: false
            }
        },
        methods: {
            updateTable() {
                axios
                    .get('/updatetable')
                    .catch(err => {
                        console.log(err.response);
                    })
            },
            getUsers() {
                axios
                    .get('/getusers')
                    .then(res => {
                        this.users = res.data[1];
                        this.ready = true;
                    })
                    .catch(err => {
                        console.log(err.response);
                    })
            }
        }
    }
</script>
