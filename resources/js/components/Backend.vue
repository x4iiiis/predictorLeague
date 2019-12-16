<template>
    <div class="container">
        <div class="row text-center">

            <div class="col-md-5 mx-auto">
                <div class="card my-2">
                    <div class="row">
                        <a class="btn btn-round btn-success col-6" v-on:click="unlock()">Unlock Predictions</a>
                        <a class="btn btn-round btn-danger col-6" v-on:click="lock()">Lock Predictions</a>
                        
                        <div v-if="locked" class="col-6 mx-auto">
                            <span class="fa fa-lock fa-5x text-danger"></span>
                        </div>
                        <div v-else-if="unlocked" class="col-6 mx-auto">
                            <span class="fa fa-unlock fa-5x text-success"></span>
                        </div>
                        <div v-else class="col-6 mx-auto">
                            <span class="fa fa-key fa-5x"></span>
                        </div>
                    </div>
                </div>

                <div class="card my-2">
                    <h3 class="card-title pt-2">Match Maker </h3>
                    <div class="card-body">


                        <form action="/match/store" method="post" @submit.prevent="onSubmit">
                            <div class="form-group">
                                <label>Home Team</label>
                                <select  class="form-control" placeholder="homeTeam" v-model="match.homeTeam">

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

                            <div class="form-group mt-3">
                                <hr class="col-8 mx-auto">
                                <label>Extra Time and / or Penalties Available</label>
                                <input class="form-control col-1 mx-auto text-center" type="checkbox" v-model="match.etp_available">
                                <hr class="col-5 mx-auto">
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>

                    </div>
                </div>
            </div>


            <div v-if="!showResulted" class="col-md-6 card mx-auto my-2">
                <div class="row">
                    <a class="btn btn-round btn-warning col-6 mx-auto" v-on:click="getResultedMatches()">Edit Resulted</a>
                </div>

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
                        <div v-for="(match, index) in matches" :key="match.id">
                            <div class="row py-2">
                                <div class="col-12 text-center mb-2">
                                    <hr>
                                    <small>
                                        {{match.kickoff.split(' ')[0]}}
                                        {{match.kickoff.split(' ')[1]}}
                                        {{match.kickoff.split(' ')[2]}}
                                        {{match.kickoff.split(' ')[3]}}
                                    </small>
                                    <h6>{{match.kickoff.split(' ')[4]}}</h6>
                                    <div class="col-9 mx-auto">
                                        <hr> 
                                        <small v-if="match.etp_available"><em>Plays to conclusion</em></small>
                                    </div>
                                </div>
                                <div class="col-3 mx-auto">
                                    <img :src="match.homeEmblem" :alt="match.homeTeam">
                                </div>
                                <div class="form-group col-6 my-auto mx-auto text-center">
                                    <input class="col-5" :name="'home' + match.id" v-model="match.homeGoals" type="number"></input>
                                    <input class="col-5" :name="'away' + match.id" v-model="match.awayGoals" type="number"></input>

                                    <div v-if="match.etp_available && match.homeGoals == match.awayGoals && match.homeGoals != null">
                                        <br />
                                        <b class="text-center">AET</b>
                                        <br />
                                        <input class="col-5" :name="'homeAET' + match.id" v-model="match.homeGoalsAET" type="number"></input>
                                        <input class="col-5" :name="'awayAET' + match.id" v-model="match.awayGoalsAET" type="number"></input>

                                        <br />
                                        <b class="text-center">Pens</b>
                                        <br />
                                        <input class="col-5" :name="'homePens' + match.id" v-model="match.homeGoalsPens" type="number"></input>
                                        <input class="col-5" :name="'awayPens' + match.id" v-model="match.awayGoalsPens" type="number"></input>
                                    </div>
                                </div>
                                <div class="col-3 mx-auto">
                                    <img :src="match.awayEmblem" :alt="match.awayTeam">
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-8 mx-auto">
                                    <hr>

                                    <div class="btn-group dropup">
                                        <span data-toggle="dropdown"><i class="fa fa-edit"></i></span>
                                        <div class="dropdown-menu">
                                        <a class="dropdown-item" v-on:click="cancelMatch(match)">P - P / A - A</a>
                                        <a class="dropdown-item" href="#">Change Date / Time</a>
                                        <a class="dropdown-item" href="#">Alter ET&P</a>
                                        <a class="dropdown-item" href="#">Reverse Fixture</a>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-lg btn-primary mx-auto mt-3">Submit</button>
                        </div>
                    </form>
                </div>

            </div>


            <div v-else class="col-md-6 card mx-auto my-2">
                <div class="row">
                    <a class="btn btn-round btn-info col-6 mx-auto" v-on:click="getUnresultedMatches()">Edit Unresulted</a>
                </div>
                <h3 class="card-title pt-2">Resulted Fixtures</h3>


                <div v-if="!ready" class="card-body">       
                    <div class="row">
                        <div class="mx-auto">
                            <Spinner></Spinner>
                        </div>
                    </div>
                </div>
                
                <div v-else class="card-body">

                    <div v-for="(match, index) in matches" :key="match.id">
                        <form action="match/addscores" method="post" @submit.prevent="resetScores(match)" class="row py-2">
                            <div class="col-12 text-center mb-2">
                                <hr>
                                <small>
                                    {{match.kickoff.split(' ')[0]}}
                                    {{match.kickoff.split(' ')[1]}}
                                    {{match.kickoff.split(' ')[2]}}
                                    {{match.kickoff.split(' ')[3]}}
                                </small>
                                <h6>{{match.kickoff.split(' ')[4]}}</h6>
                                <div class="col-9 mx-auto">
                                    <hr> 
                                </div>
                            </div>
                            <div class="col-3 mx-auto">
                                <img :src="match.homeEmblem" :alt="match.homeTeam">
                            </div>
                            <div class="form-group col-6 my-auto mx-auto text-center">
                                <h1 style="display: inline;">{{ match.homeGoals }} - </h1>
                                <h1 style="display: inline;">{{ match.awayGoals }}</h1>
                            </div>
                            <div class="col-3 mx-auto">
                                <img :src="match.awayEmblem" :alt="match.awayTeam">
                            </div>
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-lg btn-warning mx-auto">Reset</button>
                            </div>
                        </form>
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
            console.log('Fixtures Component mounted.')
            this.match.etp_available = false;
            this.getTeams();
        },
        data() {
            return {
                teams: [],
                matches: [],
                match: {},
                ready: false,
                submitted: false,
                locked: false,
                unlocked: false,
                showResulted: false,
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
                    .get('/getunresultedmatchesbackend')
                    .then(res => {
                        this.showResulted = false;
                        this.matches = res.data[1];
                        this.ready = true;
                    })
                    .catch( err => {
                        console.log(err.response);
                    })
            },
            getResultedMatches() {
                axios
                    .get('/getresultedmatchesbackend')
                    .then(res => {
                        this.showResulted = true;
                        this.matches = res.data[1];
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
                        kickoff: this.match.kickoff,
                        etp_available: this.match.etp_available
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
                        this.updateTable();
                        this.getUnresultedMatches();
                    })
                    .catch(err => {
                        console.log(err.response);
                    })
            },
            resetScores(match) {
                match.homeGoals = null;
                match.awayGoals = null;

                axios
                    .post('/match/resetmatch', {
                        match: match,
                    })
                    .then(response => {
                        console.log('Scores Reset');
                        console.log(response);
                        this.ready = false;
                        this.updateTable();
                        this.getResultedMatches();
                    })
                    .catch(err => {
                        console.log(err.response);
                    })
            },
            cancelMatch(match) {
                if(confirm("Are you sure you want to cancel " + match.homeTeam + " vs " + match.awayTeam + "?")){

                    axios
                        .post('/match/cancelmatch', {
                            match: match,
                        })
                        .then(response => {
                            console.log(match.homeTeam + " vs " + match.awayTeam + " cancelled");
                            console.log(response);
                            this.ready = false;
                            this.getUnresultedMatches();
                        })
                        .catch(err => {
                            console.log(err.response);
                        })
                }
            },
            updateTable() {
                axios
                    .get('/updatetable')
                    .then(res => {
                        console.log('League Table Updated');
                    })
                    .catch(err => {
                        console.log(err.response);
                    })
            },
            unlock() {
                axios
                    .get('/unlockpredictions')
                    .then(res => {
                        console.log('Predictions unlocked!');
                        this.locked = false;
                        this.unlocked = true;
                    })
                    .catch(err => {
                        console.log(err);
                    })
            },
            lock() {
                axios
                    .get('/lockpredictions')
                    .then(res => {
                        console.log('Predictions locked!');
                        this.unlocked = false;
                        this.locked = true;
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
