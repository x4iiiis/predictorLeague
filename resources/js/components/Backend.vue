<template>
    <div class="container">
        <div class="row text-center">

            <div class="col-md-5 card mx-auto my-2">
                <h3 class="card-title pt-2">Match Maker</h3>
                <div class="card-body">


                    <form action="/match/store" method="post" @submit.prevent="onSubmit">
                        <div class="form-group">
                            <label>Home Team</label>
                            <select  class="form-control" placeholder="homeTeam" v-model="match.homeTeam" :name="homeTeam">

                                <option v-for="(team, index) in teams" :key="team.id">{{team.name}}</option>

                            </select>
                        </div>
                        <br />
                        <div class="form-group">
                            <label>Away Team</label>
                            <select  class="form-control" placeholder="awayTeam" v-model="match.awayTeam">

                                    <option v-for="(team, index) in teams" :key="team.id">{{team.name}}</option>

                            </select>
                        </div>
                        <br />
                        <div class="form-group">
                            <label>Kickoff</label>
                            <input class="form-control" type="datetime-local" id="kickoff" placeholder="dateTime" v-model="match.kickoff">
                        </div>
                        <br />
                        <button type="submit" class="mt-5 btn btn-primary">Submit</button>
                    </form>

                </div>
            </div>


            <div class="col-md-6 card mx-auto my-2">
                <h3 class="card-title pt-2">Unresulted Fixtures</h3>


                <div v-if="!ready" class="card-body">       
                    <div class="row">
                        <div class="mx-auto">
                            <Spinner></Spinner>
                        </div>
                    </div>
                </div>
                
                <div v-else class="card-body">

                    <form action="match/addscores" method="post" @submit.prevent="onSubmitScores">
                        <div v-for="(match, index) in matches" :key="match.id" class="row py-2">
                            <div class="col-3 mx-auto">
                                <img :src="match.homeEmblem" :alt="match.homeTeam">
                            </div>
                            <div class="form-group col-6 my-auto mx-auto text-center">
                                <input class="col-5" :name="'home' + match.id" v-model="match.homegoals" type="number"></input>
                                <input class="col-5" :name="'away' + match.id" v-model="match.awayGoals" type="number"></input>
                            </div>
                            <div class="col-3 mx-auto">
                                <img :src="match.awayEmblem" :alt="match.awayTeam">
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-lg btn-primary mx-auto">Submit</button>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>
</template>

<script>
    import Spinner from '../components/Spinner.vue';

    export default {
        mounted() {
            console.log('Fixtures Component mounted.')
            this.getTeams();
        },
        data() {
            return {
                teams: [],
                matches: [],
                match: {},
                ready: false,
                submitted: false,
            }
        },
        methods: {
            getTeams() {
                axios
                    .get('/getteams')
                    .then(res => {
                        this.teams = res.data[1];
                        this.getUnresultedMatches();
                    })
                    .catch(err => {
                        console.log(err.response);
                    })
            },
            getUnresultedMatches() {
                axios
                    .get('/getunresultedmatches')
                    .then(res => {
                        this.matches = res.data[3];
                        this.ready = true;
                    })
                    .catch( err => {
                        console.log(err.response);
                    })
            },
            onSubmit() {
                axios
                    .post('/match/store', { 
                        homeTeam: this.match.homeTeam,
                        awayTeam: this.match.awayTeam,
                        kickoff: this.match.kickoff
                    })
                    .then(response => {
                        console.log('Match Created');
                        this.ready = false;
                        this.getUnresultedMatches();
                    })
                    .catch(err => {
                        console.log(err.response);
                    })
            },
            onSubmitScores() {
                axios
                    .post('/match/submitscores', {
                        matches: this.matches,
                    })
                    .then(response => {
                        console.log('Scores Recieved');
                        console.log(response);
                        this.ready = false;
                        this.getUnresultedMatches();
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
