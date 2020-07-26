<template>
    <div class="card my-2">
        <h3 class="card-title pt-2">Prediction Status'</h3>

        <a v-if="!show" class="btn-sm btn-round btn-warning mx-auto mb-2" @click="showOrHide()">Show</a>
        <a v-if="show" class="btn-sm btn-round btn-warning mx-auto mb-2" @click="showOrHide()">Hide</a>

        <div v-if="show" class="card-body">

            <table class="table table-hover" id="leagueTable">
                <tr style="text-align:center">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th></th>
                </tr>
                
                <tr v-if="!users.length > 0" style="text-align:center;">
                    <td><Spinner /></td>
                    <td><Spinner /></td>
                    <td><Spinner /></td>
                    <td></td>
                </tr>
                <tr v-for="user in users" style="text-align:center">
                    <td>{{ user.id }}</td>
                    <td>{{ user.name }}</td>
                    <td>{{ user.hasSubmitted }}</td>
                    <td><a class="btn btn-round btn-warning" @click="flipSubmissionStatus(user.id)">Flip</a></td>
                </tr>
            </table>

            <a class="btn btn-round btn-success col-5" v-on:click="unlock()">Unlock Predictions</a>
            <a class="btn btn-round btn-danger col-5" v-on:click="lock()">Lock Predictions</a>
            
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
    props: ['users'],
    methods: {
        showOrHide() {
            this.show = !this.show;
        },
        unlock() {
            axios
                .get('/unlockpredictions')
                .then(res => {
                    console.log('Predictions unlocked!');
                    this.$emit('getusers');
                })
                .catch(err => {
                    console.log(err);
                })
            },
            lock() {
                axios
                    .get('/lockpredictions')
                    .then(res => {
                        console.log('Predictions locked!');
                        this.$emit('getusers');
                    })
                    .catch(err => {
                        console.log(err);
                    })
            },
            flipSubmissionStatus(userID) {
                console.log("id n status", userID, status);

                axios
                    .post('/user/flipsubmissionstatus', {
                        id: userID,
                    })
                    .then(response => {
                        this.$emit('getusers');
                    })
                    .catch(err => {
                        console.log(err.response);
                    })
            },
    }
}
</script>