<template>
    <div class="card-body">
        <div>
            <div v-for="(match, index) in matches" :key="match.id">

                <div v-if="allPredictions[index].length > 0" class="row py-2">
                    <div class="col-12 text-center mb-2">
                        <hr>
                        <small>
                            {{ kickoffFormat(match.kickoff).split(' ')[0] }}
                            {{ kickoffFormat(match.kickoff).split(' ')[1] }}
                            {{ kickoffFormat(match.kickoff).split(' ')[2] }}
                            {{ kickoffFormat(match.kickoff).split(' ')[3] }}
                        </small>
                        <h6>{{ kickoffFormat(match.kickoff).split(' ')[4] }}</h6>
                        <div class="col-9 mx-auto">
                            <hr> 
                        </div>
                    </div>
                    <div class="col-3 mx-auto">
                        <img :src="match.homeEmblem" :alt="match.homeTeam">
                    </div>
                    <div class="col-6 mx-auto my-auto text-center">
                        <table v-if="users.length != 0">
                            <tr v-for="prediction in allPredictions[ index ]">
                                <td style="text-align:right">
                                    <small>{{ users[prediction.user_id - 1].name }}</small>
                                </td>
                                <td v-if="prediction.winner == null || !match.etp_available">
                                    <small>{{ prediction.homeGoals }} - {{ prediction.awayGoals }}</small>
                                </td>
                                <td v-else>
                                    <small>
                                        <span v-if="prediction.winner == match.homeTeam">
                                            <span>*</span>
                                        </span>
                                            {{ prediction.homeGoals }} - {{ prediction.awayGoals }}
                                        <span v-if="prediction.winner == match.awayTeam">
                                            <span>*</span>
                                        </span>
                                    </small>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-3 mx-auto">
                        <img :src="match.awayEmblem" :alt="match.awayTeam">
                    </div>
                </div>
                
            </div>
                
        </div>
    </div>
</template>

<script>
    import FormatKickoff from '../../mixins/moment/formatKickoff'
    
    export default {
        props: [
            'user',
            'users',
            'matches',
            'predictions',
            'allPredictions',
        ],
        mixins: [ FormatKickoff ],

    }
</script>