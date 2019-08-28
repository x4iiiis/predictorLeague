<template>
    <div v-if="ready" class="card">
        <div class="card-header">Upcoming Matches</div>
            <div class="card-body">
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
                    <button class="btn btn-lg btn-primary mx-auto" @click="validateInput()">Submit</button>
                </div>
            </div>
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
                user: [],
                matches: [],
                predictions: [],
                //I want userID, matchID, homescore, awayscore in predictions
                //But I dunno how tf to do it in Vue
                ready: false
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
            validateInput() {
                this.formSubmit()
            },
            formSubmit() {
                axios
                  .post('/prediction/store', {
                        predictions: this.predictions
                    })
                  .then(response =>  {
                        console.log(response.data)
                    }) 
            }
    }
}
</script>
