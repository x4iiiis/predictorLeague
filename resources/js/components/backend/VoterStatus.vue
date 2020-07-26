<template>
    <div class="card my-2">
        <h3 class="card-title pt-2">Voter Status'</h3>

        <a v-if="!show" class="btn-sm btn-round btn-warning mx-auto mb-2" @click="showOrHide()">Show</a>
        <a v-if="show" class="btn-sm btn-round btn-warning mx-auto mb-2" @click="showOrHide()">Hide</a>

        <div v-if="show" class="card-body">

            <table class="table table-hover" id="leagueTable">
                <tr style="text-align:center">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Status</th>
                </tr>
                
                <tr v-if="!users.length > 0" style="text-align:center;">
                    <td><Spinner /></td>
                    <td><Spinner /></td>
                    <td><Spinner /></td>
                </tr>
                <tr v-for="user in users" style="text-align:center">
                    <td>{{ user.id }}</td>
                    <td>{{ user.name }}</td>
                    <td>{{ user.hasVoted }}</td>
                </tr>
            </table>

            <button class="col-5 mx-auto" @click="openPolls">Open Polls</button>
            <button class="col-5 mx-auto" @click="closePolls">Close Polls</button>
            <button class="col-5 mx-auto bg-danger my-2" @click="clearVotes">Clear Polls</button>
            
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
    props: [ 'users' ],
    methods: {
        showOrHide() {
            this.show = !this.show;
        },
        openPolls() {
            axios
                .get('/openpolls')
                .then(res => {
                    console.log('Polls opened!');
                    this.$emit('getusers');
                })
                .catch(err => {
                    console.log(err);
                })
        },
        closePolls() {
            axios
                .get('/closepolls')
                .then(res => {
                    console.log('Polls closed!');
                    this.$emit('getusers');
                })
                .catch(err => {
                    console.log(err);
                })
        },
        clearVotes() {
            axios
                .get('/clearpolls')
                .then(res => {
                    console.log('Votes Deleted!');
                    this.closePolls();
                })
                .catch(err => {
                    console.log(err);
                })
        }
    }
}
</script>