<template>
    <div class="col-10 mx-auto my-2">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-8">
                        Announcement
                    </div>
                    <div class="col-4 text-right">
                        <a v-if="!show" class="btn-sm btn-round btn-warning mr-0 ml-auto" @click="showOrHide()">Show</a>
                        <a v-if="show" class="btn-sm btn-round btn-warning mr-0 ml-auto" @click="showOrHide()">Hide</a>
                    </div>
                </div>
            </div>

            <div v-if="show" class="card-body text-justify">
                <h1>Here you!</h1>

                <p>
                    Predictor League now has the ability to send you email notifications when new fixtures are released!
                </p>
                <p>
                    It also sends a reminder at 9am on a matchday to anyone who has yet to submit their predictions.
                </p>
                <p>
                    If you're interested in receiving such notifications, click the dropdown from your name at the top of the page
                    and open the 'My Account' section, tick the box, and click 'Update Profile.' Piece of piss.
                </p>
                <small><em>Blair, Colman, I've already enabled yours so you can just ignore this.</em></small>
                <p class="mt-3">
                    Please note:
                </p>
                <p>
                    These emails may end up in your junk folder so I'll still be chasing people up for predictions as long as I remember to.
                </p>

                <p>
                    Cheers,
                </p>

                <p>
                    Lots of love,
                </p>
                <p>
                    SpeckyHibsCunt x
                </p>
 
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            // console.log('Legend Component mounted.')
        },
        data() {
            return {
                show: true,
            }
        },
        methods: {
            showOrHide() {
                this.show = !this.show;
            }
        }
    }
</script>
