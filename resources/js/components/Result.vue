<template>
<div v-if="ready" class="row">
  <div class="col-12 text-center mb-2">
        <hr>
        <div v-if="!ready" class="mx-auto">
            <Spinner></Spinner>
        </div>
        <small>
            {{ kickoffFormat(this.match.kickoff).split(' ')[0] }}
            {{ kickoffFormat(this.match.kickoff).split(' ')[1] }}
            {{ kickoffFormat(this.match.kickoff).split(' ')[2] }}
            {{ kickoffFormat(this.match.kickoff).split(' ')[3] }}
        </small>
        <h6>{{ kickoffFormat(this.match.kickoff).split(' ')[4] }}</h6>
        <div class="col-9 mx-auto">
            <hr> 
        </div>
    </div>
    <div class="col-3 mx-auto">
        <img :src="this.match.homeEmblem" :alt="this.match.homeTeam">
    </div>
    <div class="col-6 mx-auto my-auto text-center">
        <h1 style="display: inline;">{{ this.match.homeGoals }} - </h1>
        <h1 style="display: inline;">{{ this.match.awayGoals }}</h1>

        <div v-if="this.match.etp_available">
            <div v-if="this.match.homeGoalsAET">
                <br />
                <b class="text-center">AET</b>

                <br />
                <h4 style="display: inline;">{{ this.match.homeGoalsAET }} - </h4>
                <h4 style="display: inline;">{{ this.match.awayGoalsAET }}</h4>

                <div v-if="this.match.homeGoalsPens">
                    <br />
                    <b class="text-center">Penalties</b>

                    <br />
                    <h4 style="display: inline;">{{ this.match.homeGoalsPens }} - </h4>
                    <h4 style="display: inline;">{{ this.match.awayGoalsPens }}</h4>
                </div>
            </div>
        </div>


            <table>
            <tr v-for="prediction in this.predictions" :key="prediction.id">

                <div v-if="prediction.homeGoals == match.homeGoals && prediction.awayGoals == match.awayGoals">
                    <td style="text-align:right">
                        <small class="text-success">{{ users[prediction.user_id - 1].name }}</small>
                    </td>
                    <td v-if="prediction.winner == null">
                        <small class="text-success">{{ prediction.homeGoals }} - {{ prediction.awayGoals }}</small>
                    </td>
                    <td v-else>
                        <small class="text-success">
                            <span v-if="prediction.winner == match.homeTeam">
                                <span v-if="prediction.winner == match.winner" class="text-success">*</span>
                                <span v-else style="color:black !important">*</span>
                            </span>
                                {{ prediction.homeGoals }} - {{ prediction.awayGoals }}
                            <span v-if="prediction.winner == match.awayTeam">
                                <span v-if="prediction.winner == match.winner" class="text-success">*</span>
                                <span v-else style="color:black !important">*</span>
                            </span>
                        </small>
                    </td>
                </div>

                <div v-else-if="(prediction.homeGoals > prediction.awayGoals && match.homeGoals > match.awayGoals) 
                        || (prediction.homeGoals < prediction.awayGoals && match.homeGoals < match.awayGoals) 
                        || (prediction.homeGoals == prediction.awayGoals && match.homeGoals == match.awayGoals)">
                    <td style="text-align:right">
                        <small style="color:#f6993f">{{ users[prediction.user_id - 1].name }}</small>
                    </td>
                    <td v-if="prediction.winner == null">
                        <small style="color:#f6993f">{{ prediction.homeGoals }} - {{ prediction.awayGoals }}</small>
                    </td>
                    <td v-else>
                        <small style="color:#f6993f">
                            <span v-if="prediction.winner == match.homeTeam">
                                <span v-if="prediction.winner == match.winner" class="text-success">*</span>
                                <span v-else style="color:black !important">*</span>
                            </span>
                                {{ prediction.homeGoals }} - {{ prediction.awayGoals }}
                            <span v-if="prediction.winner == match.awayTeam">
                                <span v-if="prediction.winner == match.winner" class="text-success">*</span>
                                <span v-else style="color:black !important">*</span>
                            </span>
                        </small>
                    </td>
                </div>

                <div v-else>
                    <td style="text-align:right">
                        <small>{{ users[prediction.user_id - 1].name }}</small>
                    </td>
                    <td v-if="prediction.winner == null">
                        <small>{{ prediction.homeGoals }} - {{ prediction.awayGoals }}</small>
                    </td>
                    <td v-else>
                        <small>
                            <span v-if="prediction.winner == match.homeTeam">
                                <span v-if="prediction.winner == match.winner" class="text-success">*</span>
                                <span v-else style="color:black !important">*</span>
                            </span>
                            {{ prediction.homeGoals }} - {{ prediction.awayGoals }}
                            <span v-if="prediction.winner == match.awayTeam">
                                <span v-if="prediction.winner == match.winner" class="text-success">*</span>
                                <span v-else style="color:black !important">*</span>
                            </span>
                        </small>
                    </td>
                </div>

            </tr>
            </table>

    </div>
    <div class="col-3 mx-auto">
        <img :src="this.match.awayEmblem" :alt="this.match.awayTeam">
    </div>
</div>
</template>

<script>
    import Spinner from '../components/Spinner.vue';
    import FormatKickoff from '../mixins/moment/formatKickoff'

    export default {
        name: 'Result',
        mounted() {
            // console.log('Match Mounted');
            this.getPredictions();
        },
        props: {
            match: Object,
            users: Array,
        },
        mixins: [ FormatKickoff ],
        data() {
            return {
                ready: false,
                predictions: {},
            };
        },
        methods: {
            getPredictions() {
                axios
                    .get('/getpredictions/' + this.match.id)
                    .then(res => {
                        this.predictions = res.data[1];
                        this.ready = true;
                    })
                    .catch(err => {
                        console.log(err);
                    })
            }
        },
        components: {
            Spinner
        }
    }
</script>
