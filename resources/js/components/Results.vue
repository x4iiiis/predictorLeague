<template>
    <div class="card my-2">
            
                <div class="card-header">Previous Matches</div>
                    <div v-if="ready" class="card-body">

                        <div v-for="match in matches" :key="match.id" class="row py-2">
                            
                            <Result :match="match" :users="users"></Result>
                            
                        </div>
                        <observer v-if="matches.length + 1 < totalResultedMatches" v-on:intersect="getMoreMatches()"></observer>
                    </div>
                    <div v-else class="card-body">
                        <div class="row">
                            <div class="mx-auto">
                                <Spinner></Spinner>
                            </div>
                        </div>
                    </div>  
                    
                </div>
        </div>
    </div>
</template>

<script>
    import Spinner from '../components/Spinner.vue';
    import Result from '../components/Result.vue';
    import Observer from '../components/Observer.vue';

    export default {
        mounted() {
            console.log('Results Component mounted.')
            this.countResultedMatches()
            this.getMatches()
        },
        data() {
            return {
                users: [],
                matches: [],
                totalResultedMatches: 0,
                ready: false,
                counter: 0
            }
        },
        methods: {
            countResultedMatches() {
                axios
                    .get('/countresultedmatches')
                    .then(res => {
                        this.totalResultedMatches = res.data[1];
                    })
            },
            getMatches() {
                axios
                    .get('/getresultedmatches/' + this.counter++)
                    .then(res => {
                        this.users = res.data[1];
                        this.matches = res.data[3];
                        this.ready = true;
                    })
                    .catch(err => {
                        console.log(err.response);
                    })
            },
            async getMoreMatches() {
                await axios
                    .get('/getresultedmatches/' + this.counter++)
                    .then(res => {
                        this.matches = [...this.matches, ...res.data[3]];
                    })
                    .catch(err => {
                        console.log(err.response);
                    })
            }
    },
    components: {
        Spinner,
        Result,
        Observer,
    }
}
</script>

