<template>
    <div  class="card my-2">
        
        <div class="card-header">League Table</div>

        <div class="card-body">
            <table class="table table-hover" id="leagueTable">
                <tr style="text-align:center">
                    <th></th>
                    <th>Points</th>
                    <th>Correct Score</th>
                    <th>Correct Outcome</th>
                </tr>
                
                <tr v-if="!users.length > 0" style="text-align:center;">
                    <td><Spinner /></td>
                    <td><Spinner /></td>
                    <td><Spinner /></td>
                    <td><Spinner /></td>
                </tr>
                <tr v-for="user in users" style="text-align:center">
                    <td>{{ user.name }}</td>
                    <td>{{ (user.correctScores * 3) + user.correctOutcomes }}</td> 
                    <td>{{ user.correctScores }}</td>
                    <td>{{ user.correctOutcomes }}</td>
                </tr>
            </table>
        </div>
    </div>
</template>

<script>
    import Spinner from '../components/Spinner.vue';

    export default {
        mounted() {
            console.log('lengf m8', this.users.length)
            console.log(this.users.length == 0)
            this.ready = true;
        },
        data() {
            return {
                ready: false
            }
        },
        props: [
            'users'
        ],
        components: {
            Spinner
        }

    }
</script>
