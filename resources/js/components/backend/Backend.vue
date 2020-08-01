<template>
    <div class="container">
        <div class="row text-center">

            <div class="col-md-5 mx-auto">
                <MatchMaker :teams="teams" @submitted="getUnresultedMatches" />
                <PredictionStatus :users="users" @getusers="getUsers" />
                <PollResults />
                <VoterStatus :users="users" @getusers="getUsers" />
            </div>


            <div v-if="!showResulted" class="col-md-6 card mx-auto mt-2 mb-5">

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
                                        {{ kickoffFormat(match.kickoff).split(' ')[0] }}
                                        {{ kickoffFormat(match.kickoff).split(' ')[1] }}
                                        {{ kickoffFormat(match.kickoff).split(' ')[2] }}
                                        {{ kickoffFormat(match.kickoff).split(' ')[3] }}
                                    </small>
                                    <h6>{{ kickoffFormat(match.kickoff).split(' ')[4] }}</h6>
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
                                        <a class="dropdown-item" data-toggle="modal" :data-target="'#teams-' + match.id">Edit Teams</a>
                                        <a class="dropdown-item" data-toggle="modal" :data-target="'#kickoff-' + match.id">Edit Kickoff</a>
                                        <a class="dropdown-item" data-toggle="modal" :data-target="'#ETP-' + match.id">Alter ET&P</a>
                                        <a class="dropdown-item" v-on:click="reverseFixture(match)">Reverse Fixture</a>
                                        </div>
                                    </div>

                                    <div class="modal fade" :id="'teams-' + match.id" tabindex="-1" role="dialog">
                                        <div class="modal-dialog modal-sm" role="document">
                                            <div class="modal-content">

                                                <div class="modal-body">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>

                                                    <form action="match/editkteams" method="post" @submit.prevent="onEditTeams(match)">
                                                        <select class="form-control my-1"  id="editHomeTeam" placeholder="dateTime" v-model="match.homeTeam">
                                                            <option v-for="(team, index) in teams" :key="team.id">{{team.name}}</option>
                                                        </select>
                                                        
                                                        <select class="form-control my-1"  id="editAwayTeam" placeholder="dateTime" v-model="match.awayTeam">
                                                            <option v-for="(team, index) in teams" :key="team.id">{{team.name}}</option>
                                                        </select>

                                                        <div class="text-center">
                                                            <button type="submit" class="btn btn-lg btn-primary mx-auto mt-3" data-toggle="modal" :data-target="'#teams-' + match.id">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" :id="'kickoff-' + match.id" tabindex="-1" role="dialog">
                                        <div class="modal-dialog modal-sm" role="document">
                                            <div class="modal-content">

                                                <div class="modal-body">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>

                                                    <form action="match/editkickoff" method="post" @submit.prevent="onEditKickoff(match)">
                                                        <input class="form-control" type="datetime-local" id="kickoff" placeholder="dateTime" v-model="match.kickoff">

                                                         <div class="text-center">
                                                            <button type="submit" class="btn btn-lg btn-primary mx-auto mt-3" data-toggle="modal" :data-target="'#kickoff-' + match.id">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" :id="'ETP-' + match.id" tabindex="-1" role="dialog">
                                        <div class="modal-dialog modal-sm" role="document">
                                            <div class="modal-content">

                                                <div class="modal-body">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>

                                                    <form action="match/editETP" method="post" @submit.prevent="onEditETP(match)">
                                                        <label>Extra Time and / or Penalties Available</label>
                                                        <input class="form-control col-1 mx-auto text-center" type="checkbox" v-model="match.etp_available">
                                
                                                        <div class="text-center">
                                                            <button type="submit" class="btn btn-lg btn-primary mx-auto mt-3" data-toggle="modal" :data-target="'#ETP-' + match.id">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
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


            <div v-else class="col-md-6 card mx-auto mt-2 mb-5">
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
                                    {{ kickoffFormat(match.kickoff).split(' ')[0] }}
                                    {{ kickoffFormat(match.kickoff).split(' ')[1] }}
                                    {{ kickoffFormat(match.kickoff).split(' ')[2] }}
                                    {{ kickoffFormat(match.kickoff).split(' ')[3] }}
                                </small>
                                <h6>{{ kickoffFormat(match.kickoff).split(' ')[4] }}</h6>
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

            <div class="col-md-4 mr-0 ml-auto">
                <SeasonReset />
            </div>

        </div>
    </div>
</template>

<script>
    import MatchMaker from '../backend/MatchMaker'
    import PredictionStatus from '../backend/PredictionStatus'
    import PollResults from '../backend/PollResults'
    import VoterStatus from '../backend/VoterStatus'
    import SeasonReset from '../backend/SeasonReset'
    import Spinner from '../Spinner'
    import FormatKickoff from '../../mixins/moment/formatKickoff'

    export default {
        mounted() {
            console.log('Fixtures Component mounted.')
            this.getTeams();
        },
        data() {
            return {
                teams: [],
                matches: [],
                ready: false,
                submitted: false,
                showResulted: false,
            }
        },
        mixins: [ FormatKickoff ],
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
                        this.recalculateTable();
                        this.getResultedMatches();
                    })
                    .catch(err => {
                        console.log(err.response);
                    })
            },
            onEditKickoff(match) {
                axios
                    .post('/match/updatekickoff', {
                        id: match.id,
                        kickoff: match.kickoff
                     })
                    .then(response => {
                        console.log('Kickoff Updated');
                        console.log(response);
                        this.ready=false;
                        this.getUnresultedMatches();
                    })
                    .catch(err => {
                        console.log(err.response);
                    })
            },
            onEditTeams(match) {
                axios
                    .post('/match/updateteams', {
                        id: match.id,
                        homeTeam: match.homeTeam,
                        awayTeam: match.awayTeam
                    })
                    .then(response => {
                        console.log('Match teams updated');
                        this.ready = false;
                        this.getUnresultedMatches();
                    })
                    .catch(err => {
                        console.log(err.response)
                    })
            },
            onEditETP(match) {
                axios
                    .post('match/updateetp', {
                        id: match.id,
                        etp_available: match.etp_available
                    })
                    .then(response => {
                        console.log('ET & Pens Availability Updated');
                        console.log(response);
                        this.ready=false;
                        this.getUnresultedMatches();
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
            reverseFixture(match) {
                if(confirm("Are you sure you want to switch sides for " + match.homeTeam + " vs " + match.awayTeam + "?")) {
                    axios.post('match/reversefixture', {
                        id: match.id,
                    })
                    .then(response => {
                        console.log(match.homeTeam + " vs " + match.awayTeam + " reversed");
                        console.log(response);
                        this.ready = false;
                        this.getUnresultedMatches();
                    })
                    .catch(err => {
                        console.log(err.response);
                    })
                }
            },
            recalculateTable() {
                axios
                    .get('/recalculatetable')
                    .then(res => {
                        console.log('League Table Updated');
                    })
                    .catch(err => {
                        console.log(err.response);
                    })
            },
            getUsers() {
                axios
                    .get('/getusers')
                    .then(res => {
                        this.users = res.data[3];
                    })
                    .catch(err => {
                        console.log(err.response);
                    })
            },
        },
        props: [
            'users',
        ],
        components: {
            MatchMaker,
            PredictionStatus,
            PollResults,
            VoterStatus,
            SeasonReset,
            Spinner,
        }
    }
</script>
