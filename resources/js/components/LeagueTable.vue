<template>
    <div  class="card my-2">
        
        <div class="card-header">League Table</div>

        <div v-if="ready" class="card-body">
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
        <div v-else class="card-body">
            <h1>Loading . . .</h1>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('League Table Component mounted.')
            this.updateTable()
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
                    .then(res => {
                        this.getUsers()
                    })
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
