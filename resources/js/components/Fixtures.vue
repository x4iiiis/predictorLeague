<template>
    <div v-if="ready" class="card">
        <div class="card-header">Upcoming Matches</div>
            <div v-if="submitted" class="card-body text-success text-center">
                Submission Successful! 
            </div>
            <div v-if="!previouslySubmitted" class="card-body">
                <form v-if="hasFixtures" action="prediction/store" method="post" @submit.prevent="onSubmit">
                    
                    <div v-if="user.name == 'Guest'" class="row">
                        <a class="mx-auto" href="/login" v-if="user.length != 0">Login or register to take part!</a>
                    </div>

                    <KickoffCountdown
                        v-else-if="matches.length != 0" 
                        :date="localTime(Object.values(matches)[0].kickoff)"
                        v-on:end="getMatches"
                    >
                        <template slot-scope="props" v-if="props.time.days < 1">
                            <h5 class="text-center">NEXT MATCH:</h5>
                            <div class="col-9 mx-auto">
                                <hr> 
                            </div>
                            <div class="text-center lead">
                                <template v-if="props.time.hours > 0">
                                    <span class="font-weight-bolder text-danger">{{ props.time.hours }}</span> Hours
                                </template>
                                <template v-if="props.time.minutes > 0">
                                    <span class="font-weight-bolder text-danger">{{ props.time.minutes }}</span> Minutes
                                </template>
                                <template>
                                    <span class="font-weight-bolder text-danger">{{ props.time.seconds }}</span> Seconds
                                </template>
                            </div>
                        </template>
                    </KickoffCountdown>


                    <div v-for="(match, index) in matches" :key="match.id" class="row py-2">
                        
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
                        <div v-if="!(match.etp_available && match.homeGoals == match.awayGoals && match.homeGoals != null)" :class="[user.name !='Guest' ? 'mx-auto col-3' : 'text-right col-6']">
                            <img :src="match.homeEmblem" :alt="match.homeTeam">
                        </div>
                        <div v-else class="col-3 mx-auto" v-on:click="match.winner = match.homeTeam">
                            <img :src="match.homeEmblem" :alt="match.homeTeam">
                        </div>
                        <div v-if="user.length != 0 && users.length != 0 && user.name!='Guest'" class="form-group col-6 my-auto mx-auto text-center">
                            <input class="col-5" :name="'home' + match.id" v-model="match.homeGoals" required type="number"></input>
                            <input class="col-5" :name="'away' + match.id" v-model="match.awayGoals" required type="number"></input>
                        </div>
                        <div v-if="!(match.etp_available && match.homeGoals == match.awayGoals && match.homeGoals != null)" :class="[user.name !='Guest' ? 'mx-auto col-3' : 'ml-0 mr-auto col-6']">
                            <img :src="match.awayEmblem" :alt="match.awayTeam">
                        </div>
                        <div v-else class="col-3 mx-auto" v-on:click="match.winner = match.awayTeam">
                            <img :src="match.awayEmblem" :alt="match.awayTeam">
                        </div>
                        <!-- Cup / Playoff matches -->
                        <div v-if="match.etp_available && match.homeGoals != null && match.homeGoals == match.awayGoals" class="col-10 text-justify mx-auto">
                            <hr>
                            <p><small>This match is to be played to a conclusion.</small><p>
                            <p>
                                <small>
                                    Please click the crest of the team that you believe will win 
                                    the tie after extra time and / or penalty kicks.
                                </small>
                            </p>

                            <div v-if="match.winner != null" class="text-primary">
                                <p>
                                    <small>
                                        You have selected
                                    </small> 
                                    <b>{{ match.winner }}</b> 
                                    <small>
                                        to win the tie in extra time or on penalties after a 
                                        {{ match.homeGoals }} - {{ match.awayGoals }} 
                                        draw in 90 minutes.
                                    </small>
                                </p>
                            </div>
                            <div v-else class="text-danger">
                                <p>You haven't selected an overall tie winner</p>
                            </div>
                            
                        </div>
                    </div>
                    <!-- @endforeach -->
                    <div v-if="user.length != 0 && users.length != 0 && user.name!='Guest'" class="text-center">
                        <button class="btn btn-lg btn-primary mx-auto">Submit</button>
                    </div>
                </form>
                <div v-else class="row">
                    <div class="mx-auto">
                        <Spinner></Spinner>
                    </div>
                </div>
            </div>

            <div v-else class="card-body">
                <div v-if="hasFixtures">
                    <div v-for="(match, index) in matches" :key="match.id">

                        <div v-if="allPredictions[index].length > 0" class="row py-2">
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
                            <div class="col-6 mx-auto my-auto text-center">
                                <table v-if="users.length != 0">
                                    <tr v-for="prediction in allPredictions[ index ]">
                                        <td style="text-align:right">
                                            <small>{{ users[prediction.user_id - 1].name }}</small>
                                        </td>
                                        <td v-if="prediction.winner == null">
                                            <small>{{ prediction.homeGoals }} - {{ prediction.awayGoals }}</small>
                                        </td>
                                        <td v-else>
                                            <small>
                                                <span v-if="prediction.winner == match.homeTeam">
                                                    <span>*</span>
                                                </span>
                                                    {{ prediction.homeGoals }} - {{ prediction.awayGoals }}
                                                <span v-if="prediction.winner == match.awayTeam">
                                                    <span>*</span>
                                                </span>
                                            </small>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-3 mx-auto">
                                <img :src="match.awayEmblem" :alt="match.awayTeam">
                            </div>
                        </div>
                        
                    </div>
                        
                </div>
            </div>
            <div v-else class="row">
                <div class="mx-auto">
                    <Spinner></Spinner>
                </div>
            </div>

        </div>
    </div>

    <div v-else-if="submitted" class="card">
        <div class="card-header">Upcoming Matches</div>
        <div class="card-body">
            <p>Thanks for your submission.</p>
            <p>Good luck!</p>
        </div>
    </div>

    <div v-else class="card">
        <div class="card-header">Upcoming Matches</div>
        <div class="card-body">
            <div class="row">
                <div class="mx-auto">
                    <Spinner></Spinner>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Spinner from '../components/Spinner';
    import KickoffCountdown from '../components/ui/KickoffCountdown';
    import TimeUntilDateInMilliseconds from '../mixins/moment/timeUntilDateInMilliseconds'
    import LocalTime from '../mixins/moment/localTime'
    import FormatKickoff from '../mixins/moment/formatKickoff'

    export default {
        async mounted() {
            // console.log('Fixtures Component mounted.')
            await this.getMatches();

            let func = () => {
                this.timeToNextKickoffInMilliseconds = this.timeUntilDateInMilliseconds(this.localTime(Object.values(this.matches)[0].kickoff))
            }
            this.timer = setInterval(func, 1000)
            func()
        },
        data() {
            return {
                matches: [],
                predictions: {},
                hasFixtures: false,
                ready: true,
                submitted: false,
                previouslySubmitted: false,
                allPredictions: [],
                timeToNextKickoffInMilliseconds: 1001,
                timer: null,
            }
        },
        mixins: [ TimeUntilDateInMilliseconds, LocalTime, FormatKickoff ],
        methods: {
            getMatches() {
                axios
                    .get('/getupcomingmatches')
                    .then(res => {
                        this.matches = res.data[1];

                        if(res.data[3]) {
                            //Get everyone's predictions here
                            this.getUnresultedMatches()
                        }
                        else {
                            this.hasFixtures = true;
                        }
                    })
                    .catch(err => {
                        console.log(err.response);
                    })
            },
            getUnresultedMatches() {
                axios
                    .get('/getunresultedmatches')
                    .then(res => {
                        this.matches = res.data[1];
                        this.allPredictions = res.data[3];
                        this.previouslySubmitted = true;
                        this.hasFixtures = true;

                        this.timeToNextKickoffInMilliseconds = this.timeUntilDateInMilliseconds(this.localTime(Object.values(this.matches)[0].kickoff))
                    })
                    .catch( err => {
                        console.log(err.response);
                    })
            },
            onSubmit() {
                axios
                    .post('/api/prediction', { match: this.matches, user_id: this.user.id })
                    .then((response) => {
                        // console.log('Predictions received');
                        
                        this.submitted = true;
                        this.hasFixtures = false;

                        var self = this;
                        setTimeout( function() {
                            self.submitted = false;
                            self.getUnresultedMatches();
                        }, 2000);
                    })
                    .catch(err => {
                        console.log(err.response);
                    })
                
            },
        },
        props: [
            'users',
            'user'
        ],
        components: {
            Spinner,
            KickoffCountdown
        },
        beforeDestroy() {
            clearInterval(this.timer);
        }
}
</script>
