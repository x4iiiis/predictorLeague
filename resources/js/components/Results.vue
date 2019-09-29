<template>
    <div class="card my-2">
            
                <div class="card-header">Previous Matches</div>
                    <div v-if="ready" class="card-body">

                        <div v-for="match in matches" :key="match.id" class="row py-2">
                            
                            <Result :match="match" :key="match.id" :users="users"></Result>
                            
                        </div>
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

    export default {
        mounted() {
            console.log('Results Component mounted.')
            this.getMatches()
        },
        data() {
            return {
                users: [],
                matches: [],
                predictions: [],
                ready: false
            }
        },
        methods: {
            getMatches() {
                axios
                    .get('/getresultedmatches')
                    .then(res => {
                        this.users = res.data[1];
                        this.matches = res.data[3];
                        this.ready = true;
                    })
                    .catch(err => {
                        console.log(err.response);
                    })
            }
    },
    components: {
        Spinner,
        Result,
    }
}
</script>

