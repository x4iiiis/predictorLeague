<template>
    <div class="card my-2">
            
        <div class="card-header">Previous Matches</div>

        <div v-if="ready" class="card-body">
            <div v-if="matches.length > 0">
                <div v-for="match in matches" :key="match.id" class="row py-2">
                    
                    <Result :match="match" :users="users"></Result>
                    
                </div>
            </div>
            <div v-else class="row">
                <div class="mx-auto">
                    <Spinner></Spinner>
                </div>
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
</template>

<script>
    import Spinner from '../components/Spinner.vue';
    import Result from '../components/Result.vue';
    import Observer from '../components/Observer.vue';

    export default {
        mounted() {
            // console.log('Results Component mounted.')
            this.countResultedMatches()
        },
        data() {
            return {
                matches: [],
                totalResultedMatches: 0,
                ready: false,
                counter: 0 //This should probably be 0 or -1 but postponed fixtures are breaking things somehow
            }
        },
        methods: {
            countResultedMatches() {
                axios
                    .get('/countresultedmatches')
                    .then(res => {
                        this.totalResultedMatches = res.data[1];
                        this.getMoreMatches();
                    })
                    .catch(err => {
                        console.log(err.response);
                    })
            },
            async getMoreMatches() {
                await axios
                    .get('/getresultedmatches/' + this.counter++)
                    .then(res => {
                        this.matches = [...this.matches, ...res.data[1]];
                        this.ready = true;
                    })
                    .catch(err => {
                        console.log(err.response);
                    })
            }
    },
    props: [
        'users'
    ],
    components: {
        Spinner,
        Result,
        Observer,
    }
}
</script>

