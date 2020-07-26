<template>
    <div class="card my-2">
        <h3 class="card-title pt-2">Poll Results</h3>

        <a v-if="!show" class="btn-sm btn-round btn-warning mx-auto mb-2" @click="showOrHide()">Show</a>
        <a v-if="show" class="btn-sm btn-round btn-warning mx-auto mb-2" @click="showOrHide()">Hide</a>

        <div v-if="show && votes.length > 0" class="card-body">

            <span>Question:</span>
            <div class="col-11 mx-auto mt-2">
                <PollQuestion />

                <div v-if="this.votes.length > 0">
                    <div v-for="(vote, index) in voteCount" class="col-12 px-0">
                        
                        <span class="mr-3">{{ votePercentages[index] }} %</span> - {{ availableAnswers()[index] }}
                        <div class="bg-info mb-3" v-bind:style="{width: votePercentages[index] + '%'}" style="height: 20px;"></div>
                    </div>
                </div>

            </div>
            
        </div>
    </div>
</template>

<script>
import PollQuestion from '../../components/democracy/PollQuestion';
// import VotingOptions from '../democracy/VotingOptions';
import PollAnswers from '../../mixins/PollAnswers'

export default {
    mounted() {
        this.getVotes();
    },
    data() {
        return {
            show: false,
            votes: [],
            voteCount: [],
            votePercentages: [],
        }
    },
    mixins: [ PollAnswers ],
    methods: {
        showOrHide() {
            this.show = !this.show;
        },
        getVotes() {
            axios
                .get('/getvotes')
                .then(res => {
                    this.votes = res.data;
                    this.countVotes();
                })
                .catch(err => {
                    console.log(err.response);
                })
        },
        countVotes() {
            for(var i = 0; i <  this.availableAnswers().length; i++) {
                this.voteCount[i] = 0;
            }

            for(i = 0; i <  this.availableAnswers().length; i++) {
                for(var j = 0; j < this.votes.length; j++) {
                    if(this.votes[j].vote == this.availableAnswers()[i]) {
                        this.voteCount[i] += 1;
                    } 
                }
            }

            for(i = 0; i < this.voteCount.length; i++) {
                this.votePercentages[i] = parseFloat(( this.voteCount[i] / this.votes.length ) * 100).toFixed(2);
            }
        },
    },
    components: {
        PollQuestion
    }
}
</script>