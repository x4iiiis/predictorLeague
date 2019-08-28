<template>
    <div v-if="ready" class="card">
        <div class="card-header">Upcoming Matches</div>
            <div class="card-body">
                <form action="prediction/store" method="post" @submit.prevent="onSubmit">
                    <div v-for="(match, index) in matches" :key="match.id" class="row py-2">
                        <div class="col-3 mx-auto">
                            <img :src="match.homeEmblem" :alt="match.homeTeam">
                        </div>
                        <div class="form-group col-6 my-auto mx-auto text-center">
                            <input class="col-5" :name="'home' + match.id" v-model="match.home" required type="number"></input>
                            <input class="col-5" :name="'away' + match.id" v-model="match.away" required type="number"></input>
                        </div>
                        <div class="col-3 mx-auto">
                            <img :src="match.awayEmblem" :alt="match.awayTeam">
                        </div>
                    </div>
                    <!-- @endforeach -->
                    <div class="text-center">
                        <button class="btn btn-lg btn-primary mx-auto">Submit</button>
                    </div>
                </form>
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
</template>

<script>
    import axios from 'axios';

    export default {
        mounted() {
            console.log('Fixtures Component mounted.')
            this.getMatches()
        },
        data() {
            return {
                user: [],
                matches: [],
                predictions: {},
                ready: false,
                submitted: false
            }
        },
        methods: {
            getMatches() {
                axios
                    .get('/getupcomingmatches')
                    .then(res => {
                        this.user = res.data[1]
                        this.matches = res.data[3];
                        this.ready = true;
                    })
                    .catch(err => {
                        console.log(err.response);
                    })
            },
            onSubmit() {
                axios
                    .post('/api/prediction', { match: this.matches, userID: this.user.id })
                    .then((response) => {
                        console.log('Predictions received');
                    })
                    .catch(err => {
                        console.log(err.response);
                    })
                this.submitted = true;
                this.ready = false;
            }
    }
}
</script>
