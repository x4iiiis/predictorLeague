<template>
<div class="row">
  <div class="col-12 text-center mb-2">
        <hr>
        <small>
            {{this.match.kickoff.split(' ')[0]}}
            {{this.match.kickoff.split(' ')[1]}}
            {{this.match.kickoff.split(' ')[2]}}
            {{this.match.kickoff.split(' ')[3]}}
        </small>
        <h6>{{this.match.kickoff.split(' ')[4]}}</h6>
        <div class="col-9 mx-auto">
            <hr> 
        </div>
    </div>
    <div class="col-3 mx-auto">
        <img :src="this.match.homeEmblem" :alt="this.match.homeTeam">
    </div>
    <div class="col-6 mx-auto my-auto text-center">
        <h1 style="display: inline;">{{ this.match.homegoals }} - </h1>
        <h1 style="display: inline;">{{ this.match.awayGoals }}</h1>

            <table>
            <tr v-for="prediction in this.predictions" :key="prediction.id">
                <td style="text-align:right">
                    <small>{{ users[prediction.userID - 1].name }}</small>
                </td>
                <td>
                    <small>{{ prediction.homeGoals }} - {{ prediction.awayGoals }}</small>
                </td>
            </tr>
            </table>

    </div>
    <div class="col-3 mx-auto">
        <img :src="this.match.awayEmblem" :alt="this.match.awayTeam">
    </div>
</div>
</template>

<script>
export default {
    name: 'Result',
    mounted() {
        console.log('Match Mounted');
        // console.log(this.match);
        // console.log(this.predictions);
        // console.log(this.users);
    },
    props: {
        match: Object,
        predictions: Object,
        users: Array,
    }
}
</script>

<style>

</style>
