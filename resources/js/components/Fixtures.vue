<template>
    <div class="card" id="top">
        <div class="card-header">Upcoming Matches</div>
            
            <FixtureForm 
                v-if="!previouslySubmitted && hasFixtures && ready" 
                v-on:submitted="getUnresultedMatches"
                v-on:getmatches="getMatches"
                :user="user"
                :users="users"
                :matches="matches"
            />

            <FixtureList v-else-if="previouslySubmitted && hasFixtures && ready" 
                :user="user"
                :users="users"
                :matches="matches"
                :predictions="predictions"
                :all-predictions="allPredictions"
            />
            
            <div v-if="!ready" class="row">
                <div class="mx-auto">
                    <Spinner></Spinner>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    import FixtureForm from '../components/fixtures/FixtureForm';
    import FixtureList from '../components/fixtures/FixtureList';
    import Spinner from '../components/Spinner';

    export default {
        async mounted() {
            // console.log('Fixtures Component mounted.')
            await this.getMatches();
        },
        data() {
            return {
                matches: [],
                predictions: {},
                hasFixtures: false,
                ready: false,
                previouslySubmitted: false,
                allPredictions: [],
            }
        },
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
                            this.ready = true;
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
                        this.ready = true;

                        this.timeToNextKickoffInMilliseconds = this.timeUntilDateInMilliseconds(this.localTime(Object.values(this.matches)[0].kickoff))
                    })
                    .catch( err => {
                        console.log(err.response);
                    })
            }
        },
        props: [
            'users',
            'user'
        ],
        components: {
            FixtureForm,
            FixtureList,
            Spinner
        },
        beforeDestroy() {
            clearInterval(this.timer);
        }
}
</script>
