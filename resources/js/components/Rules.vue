<template>
    <div class="mr-0 ml-auto my-2">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-9">
                        Rules 
                    </div>
                    <div class="col-3 text-right">
                        <a v-if="!show" class="btn-sm btn-round btn-warning mr-0 ml-auto" @click="showOrHide()">Show</a>
                        <a v-if="show" class="btn-sm btn-round btn-warning mr-0 ml-auto" @click="showOrHide()">Hide</a>
                    </div>
                </div>
            </div>

            <div v-if="show" class="card-body">
                <ul>
                    <li><p>Correct score: 3 points</p></li>
                    <li><p>Wrong score, correct outcome: 1 point</p></li>
                    <hr>
                    <li><p>Cup / playoff matches are initially based on 90 minutes</p></li>
                    <ul>
                        <li>
                            <p>
                                If you pick a winner in your initial score prediction and the
                                match goes to extra time and / or penalties, 1 point will be awarded
                                if your winner wins the overall tie
                            </p>
                        </li>
                        <li>
                            <p>
                                When predicting a draw in a match that is to be played to conclusion, you will be 
                                prompted to select an overall tie winner; For which a bonus point will be awarded
                                on success <b>if the match goes beyond 90 minutes</b>
                            </p>
                        </li>
                        <em>
                            These points will be added to your Correct Outcome tally
                        </em>
                    </ul>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            // console.log('Rules Component mounted.')
        },
        data() {
            return {
                show: false,
            }
        },
        methods: {
            showOrHide() {
                this.show = !this.show;
            }
        }
    }
</script>
