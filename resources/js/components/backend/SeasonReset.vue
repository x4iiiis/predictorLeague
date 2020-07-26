<template>
    <div class="card my-2">
        <h3 class="card-title pt-2">Season Reset</h3>

        <a v-if="!show" class="btn-sm btn-round btn-warning mx-auto mb-2" @click="showOrHide()">Show</a>
        <a v-if="show" class="btn-sm btn-round btn-warning mx-auto mb-2" @click="showOrHide()">Hide</a>

        <div v-if="show" class="card-body">
            <a class="btn btn-round btn-danger col-5" v-on:click="resetSeason()">Reset Season</a>
        </div>

    </div>
</template>

<script>
export default {
    data() {
        return {
            show: false,
        }
    },
    methods: {
        showOrHide() {
            this.show = !this.show;
        },
        resetSeason() {
            if(confirm("Are you sure you want to reset the season?")) {
                axios
                    .get('/resetseason')
                    .then(res => {
                        console.log(res);
                    })
                    .catch(err => {
                        console.log(err.response);
                    })
            }
        }
    }
}
</script>