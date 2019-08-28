<template>
    <div v-if="ready" class="card">
        <div class="card-header">Upcoming Matches</div>
            <div class="card-body">
                <form action="prediction/store" method="post" @submit="onSubmit">
                    <input type="hidden" name="_token" :value="csrf">
                    <div v-for="match in matches" class="row py-2">
                        <div class="col-3 mx-auto">
                            <img :src="match.homeEmblem" :alt="match.homeTeam">
                        </div>
                        <div class="form-group col-6 my-auto mx-auto text-center">
                            <input class="col-5" :name="'home' + match.id" required type="number"></input>
                            <input class="col-5" :name="'away' + match.id" required type="number"></input>
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
    export default {
        mounted() {
            console.log('Fixtures Component mounted.')
            this.getMatches()
        },
        data() {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                user: [],
                matches: [],
                predictions: [],
                //I want userID, matchID, homescore, awayscore in predictions
                //But I dunno how tf to do it in Vue
                ready: false,
                submitted: false
            }
        },
        methods: {
            getMatches() {
                axios
                    .get('/getupcomingmatches')
                    .then(res => {
                        console.log('getting fixtures...');
                        console.log(res.data);
                        this.user = res.data[1]
                        this.matches = res.data[3];
                        console.log("fixtures:");
                        console.log(this.matches);
                        this.ready = true;
                    })
                    .catch(err => {
                        console.log(err.response);
                    })
            },
            onSubmit() {
                return true;
                this.submitted = true;
                this.ready = false;
            }
    }
}
</script>
