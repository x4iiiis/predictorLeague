<template>
    <div class="card my-2">
        
        <div class="card-header">League Table</div>

        <div class="card-body">
            <table class="table table-hover">
                <tr style="text-align:center">
                    <th class="d-none d-lg-block"></th>
                    <th></th>
                    <th>Points</th>
                    <th>Correct Score</th>
                    <th>Correct Outcome</th>
                </tr>
                
                <tr v-if="!users.length > 0" style="text-align:center;">
                    <td class="d-none d-lg-block"><td/>
                    <td><Spinner /></td>
                    <td><Spinner /></td>
                    <td><Spinner /></td>
                    <td><Spinner /></td>
                </tr>
                <tr v-for="(user, index) in users" style="text-align:center">
                    <td class="d-none d-lg-block">{{ index + 1 }}</td>
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
