<template>
    <div class="card my-2">
            
                <div class="card-header">Previous Matches</div>
                    <div v-if="ready" class="card-body">

                        <div v-for="match in matches" class="row py-2">
                            <div class="col-3 mx-auto">
                                <img :src="match.homeEmblem" :alt="match.homeTeam">
                            </div>
                            <div class="col-6 mx-auto my-auto text-center">
                                <h1 style="display: inline;">{{ match.homegoals }} - </h1>
                                <h1 style="display: inline;">{{ match.awayGoals }}</h1>


                                    <table>
                                    <tr v-for="prediction in predictions[ match.id - 1 ]">
                                        <td style="text-align:right">
                                            <small>{{ users[prediction.userID - 1].name }}</small>
                                        </td>
                                        <td>
                                            <small>{{ prediction.homeGoals }} - {{ prediction.awayGoals }}</small>
                                        </td>
                                    </tr>
                                    </table>

                            </div>
                            <div class="col-3 mx-auto">
                                <img :src="match.awayEmblem" :alt="match.awayTeam">
                            </div>
                        </div>
                    </div>
                    <div v-else class="card-body">
                        <div class="row">
                            <div class="mx-auto">
                                <Spinner></Spinner>
                            </div>
                        </div>
                    </div>  
                    
                </div>
        </div>
    </div>
</template>

<script>
    import Spinner from '../components/Spinner.vue';

    export default {
        mounted() {
            console.log('Results Component mounted.')
            this.getMatches()
        },
        data() {
            return {
                users: [],
                matches: [],
                predictions: [],
                ready: false
            }
        },
        methods: {
            getMatches() {
                axios
                    .get('/getresultedmatches')
                    .then(res => {
                        this.users = res.data[1];
                        this.matches = res.data[3];
                        this.predictions = res.data[5];
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

