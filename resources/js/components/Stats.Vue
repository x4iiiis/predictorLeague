<template>
    <div  class="card my-2">
        
        <div class="card-header">
            <div class="row">
                <div class="col-9">
                    Statistics
                </div>
                <div class="col-3 text-right">
                    <a v-if="!show" class="btn-sm btn-round btn-warning mr-0 ml-auto" @click="showOrHide()">Show</a>
                    <a v-if="show" class="btn-sm btn-round btn-warning mr-0 ml-auto" @click="showOrHide()">Hide</a>
                </div>
            </div>
        </div>

        <div v-if="show" class="card-body">
            <p class="text-right"><small>There are {{ totalResultedMatches }} resulted matches so far</small></p>

            <table class="table table-hover">
                <tr style="text-align:center">
                    <th></th>
                    <th>Predictions</th>
                    <th>Correct Score %</th>
                    <th>Correct Outcome %</th>
                </tr>
                
                <tr v-if="!users.length > 0" style="text-align:center;">
                    <td><Spinner /></td>
                    <td><Spinner /></td>
                    <td><Spinner /></td>
                    <td><Spinner /></td>
                </tr>
                <tr v-for="user in users" style="text-align:center">
                    <td>{{ user.name }}</td>
                    <td>{{ user.totalPredictions }}</td> 
                    <td>{{ parseFloat((user.correctScores / user.totalPredictions) * 100).toFixed(2) }}</td>
                    <td>{{ parseFloat((user.correctOutcomes /user.totalPredictions) * 100).toFixed(2) }}</td>
                </tr>
            </table>
        </div>
    </div>
</template>

<script>
    import Spinner from '../components/Spinner.vue';

    export default {
        mounted() {
            this.countResultedMatches();
        },
        data() {
            return {
                show: false,
                totalResultedMatches: 0,
            }
        },
        methods: {
            countResultedMatches() {
                axios
                    .get('/countresultedmatches')
                    .then(res => {
                        this.totalResultedMatches = res.data[1];
                    })
                    .catch(err => {
                        console.log(err.response);
                    })
            },
            showOrHide() {
                this.show = !this.show;
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
