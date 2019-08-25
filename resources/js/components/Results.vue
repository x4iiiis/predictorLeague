<template>
    <div v-if="ready" class="card">
            
                <div class="card-header">Previous Matches</div>
                    <div class="card-body">

                    <!--
                        @isset($prevMatches)
                            @if(sizeof($prevMatches) != 0)
                                @foreach($prevMatches as $prevMatch)
                    -->

                                <div v-for="match in matches" class="row py-2">
                                    <div class="col-3 mx-auto">
                                        <img :src="match.homeEmblem" :alt="match.homeTeam">
                                    </div>
                                    <div class="col-6 mx-auto my-auto text-center">
                                        <h1 style="display: inline;">{{ match.homegoals }} - </h1>
                                        <h1 style="display: inline;">{{ match.awayGoals }}</h1>

                                        <!-- @isset($predictions) -->

                                            <table>
                                            <!-- @foreach($predictions[  match.id  - 1] as $prediction) -->
                                            <tr v-for="prediction in predictions[ match.id - 1 ]">
                                                <td style="text-align:right">
                                                    <small>{{ users[prediction.userID - 1].name }}</small>
                                                </td>
                                                <td>
                                                    <small>{{ prediction.homeGoals }} - {{ prediction.awayGoals }}</small>
                                                </td>
                                            </tr>
                                            <!-- @endforeach -->
                                            </table>
                                        <!-- @endisset -->

                                    </div>
                                    <div class="col-3 mx-auto">
                                        <img :src="match.awayEmblem" :alt="match.awayTeam">
                                    </div>
                                </div>
                                <!-- @endforeach
                            @endif
                        @endisset -->
                    </div>
                    
                </div>
        </div>
    </div>
</template>

<script>
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
                        console.log('getting results...');
                        console.log(res.data);
                        this.users = res.data[1];
                        this.matches = res.data[3];
                        this.predictions = res.data[5];
                        console.log('users:');
                        console.log(this.users);
                        console.log("results:");
                        console.log(this.matches);
                        console.log('predictions:');
                        console.log(this.predictions);
                        this.ready = true;
                    })
                    .catch(err => {
                        console.log(err.response);
                    })
            }
    }
}
</script>

