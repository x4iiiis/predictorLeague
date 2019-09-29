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
            <div class="row">
                <div class="mx-auto">
                    <Spinner></Spinner>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Spinner from '../components/Spinner.vue';

    export default {
        mounted() {
            console.log('League Table Component mounted.')
            
            var self = this;
            setTimeout( function() {
                self.getUsers();
            }, 1000);
            
        },
        data() {
            return {
                users: [],
                ready: false
            }
        },
        methods: {
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
        },
        components: {
            Spinner
        }

    }
</script>
