<template>
    <div class="mr-0 ml-auto my-2">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12">
                        Polling Station 
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div v-if="!voted">
                    <PollQuestion />                    

                    <VotingOptions 
                        class="row" 
                        :options="availableAnswers()" 
                        :user="user" 
                        @voted="getVotes"
                    />
                </div>
                <div v-else>
                    <p>Thanks for your vote. Here are the current vote standings:</p>

                    <span>Question:</span>
                    <div class="col-11 mx-auto mt-2">
                        <PollQuestion />

                        <div v-if="this.votes.length > 0">
                            <div v-for="(vote, index) in voteCount" class="col-12 px-0">
                                
                                <span class="mr-3">{{ votePercentages[index] }} %</span> - {{ availableAnswers()[index] }}
                                <div class="bg-info mb-3" v-bind:style="{width: votePercentages[index] + '%'}" style="height: 20px;"></div>
                            </div>
                        </div>

                        <div v-else class="col-1 mx-auto">
                            <Spinner />
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
</template>

<script>
import PollQuestion from '../democracy/PollQuestion';
import VotingOptions from '../democracy/VotingOptions';
import PollAnswers from '../../../mixins/PollAnswers'
import Spinner from '../Spinner.vue';

export default {
    data() {
        return {
            voted: false,
            votes: [],
            voteCount: [],
            votePercentages: [],
        }
    },
    mixins: [ PollAnswers ],
    methods: {
        getVotes() {
            this.voted = true;

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

            this.$emit('voted');
        }
    },
    props: [
        'user'
    ],
    components: {
        PollQuestion,
        VotingOptions,
        Spinner,
    }
}
</script>