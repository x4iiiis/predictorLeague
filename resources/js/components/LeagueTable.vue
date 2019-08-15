<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <!--
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
                    -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('League Table Component mounted.')
            this.updateTable()
        },
        methods: {
            updateTable() {
                axios
                    .get('/updatetable')
                    .then(res => {
                        console.log("League Table Updated");
                    })
                    .catch(err => {
                        console.log(err.response);
                    })
            }
        }
    }
</script>
