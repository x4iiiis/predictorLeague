<template>
    <div class="card my-2">
        <h3 class="card-title pt-2">Match Maker </h3>
        <div class="card-body">
            <table class="table">
                <tr>
                    <td><a href="https://www.bbc.co.uk/sport/football/scottish-premiership/scores-fixtures" target="_blank">Scottish Premiership</a></td>
                    <td><a href="https://www.bbc.co.uk/sport/football/premier-league/scores-fixtures" target="_blank">Premier League</a></td>
                </tr>
                <tr>
                    <td><a href="https://www.bbc.co.uk/sport/football/scottish-cup/scores-fixtures" target="_blank">Scottish Cup</a></td>
                    <td><a href="https://www.bbc.co.uk/sport/football/fa-cup/scores-fixtures" target="_blank">FA Cup</a></td>
                </tr>
                <tr>
                    <td><a href="https://www.bbc.co.uk/sport/football/scottish-league-cup/scores-fixtures" target="_blank">Scottish League Cup</a></td>
                    <td><a href="https://www.bbc.co.uk/sport/football/league-cup/scores-fixtures" target="_blank">English League Cup</a></td>
                </tr>
                <!-- <tr>
                    <td><a href="https://www.bbc.co.uk/sport/football/scottish-championship/scores-fixtures" target="_blank">Scottish Championship</a></td>
                    <td></td>
                </tr> -->
            </table>

            <form action="/match/store" method="post" @submit.prevent="onSubmit">
                <div class="form-group">
                    <label>Home Team</label>
                    <select  class="form-control" placeholder="homeTeam" v-model="match.homeTeam">

                        <option v-for="(team, index) in teams" :key="team.id">{{team.name}}</option>

                    </select>
                </div>
                <br />
                <div class="form-group">
                    <label>Away Team</label>
                    <select  class="form-control" placeholder="awayTeam" v-model="match.awayTeam">

                            <option v-for="(team, index) in teams" :key="team.id">{{team.name}}</option>

                    </select>
                </div>
                <br />
                <div class="form-group">
                    <label>Kickoff</label>
                    <input class="form-control" type="datetime-local" id="kickoff" placeholder="dateTime" v-model="match.kickoff">
                </div>

                <div class="form-group mt-3">
                    <hr class="col-8 mx-auto">
                    <label>Extra Time and / or Penalties Available</label>
                    <input class="form-control col-1 mx-auto text-center" type="checkbox" v-model="match.etp_available">
                    <hr class="col-5 mx-auto">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            match: { 
                etp_available: false,
            },
        }
    },
    props: ['teams'],
    methods: {
        onSubmit() {
            axios
                .post('/match/store', { 
                    homeTeam: this.match.homeTeam,
                    awayTeam: this.match.awayTeam,
                    kickoff: this.match.kickoff,
                    etp_available: this.match.etp_available
                })
                .then(response => {
                    // console.log('Match Created');
                    this.$emit('submitted');
                })
                .catch(err => {
                    console.log(err.response);
                })
        },
    }
}
</script>