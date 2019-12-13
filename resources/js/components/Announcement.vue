<template>
    <div v-if="ready = true" class="modal fade" id="modal-long" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
        <div class="modal-dialog modal-long" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Here you, haud oan the noo!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body row">
                    <div class="container text-justify">
                        <p>{{ greeting }}</p>

                        <p>Listen, I've got something to tell you.</p>

                        <p class="mt-2">I've snuck in some new functionality to spice things up a wee bit.</p>


                        <p>
                            Up until now, cup games that've gone to extra time and beyond have
                            only counted the first 90 minutes towards predictor points, and the
                            overall outcome has been irrelevant. 
                        </p>
                        
                        <p>No more!</p>

                        </p>

                        <p>
                            Here's some screenshots from development to <i>hopefully</i> explain the new
                            additions. Of course, these won't matter until the cup games in January,
                            but I'm chucking it in now 'cause fuck it!
                        </p>

                        <p class="mt-4">New Rules Section:</p>

                        <img class="col-11 mx-auto" src="img/announcements/Screenshot 2019-12-09 at 22.57.44.png">
                    
                        <p class="mt-4">How it looks in action:</p>
                    
                        <img class="col-11 mx-auto" src="img/announcements/Screenshot 2019-12-09 at 22.56.28.png">
                        <img class="col-11 mx-auto mt-3" src="img/announcements/Screenshot 2019-12-09 at 22.56.42.png">
                    
                        <p class="mt-3">Comprende?</p>
                    </div>

                    
                </div>

                <div class="modal-footer">
                    <img class="col-5 mx-auto" src="img/announcements/annieTrifle.jpg">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Take it oot ma face</button>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        async mounted() {
            console.log('Announcement Component mounted.')

            await this.getUser();

            this.announceAnnouncement();
        },
        data() {
            return {
                user: {},
                greeting: '',
                ready: false
            }
        },
        methods: {
            getUser() {
                axios
                    .get('/whoami')
                    .then(response => {
                        this.user = response.data[1];
                        console.log(this.user);
                        this.greeting = this.setGreeting();
                        this.ready = true;
                    })
                    .catch(err => {
                        console.log(err.response)
                    })
            },
            announceAnnouncement() {
                $('#modal-long').modal({show: true});
            },
            setGreeting() {
                console.log('sup');
                switch(this.user.name.split(" ")[0]){
                    case "Ryan":
                        return "Awryt shagger, how ye dain?";
                    case "Cheree": 
                        return "Awryt Cheree doll, how ye dain?";
                    case "Darren": 
                        return "Haw haw jaw baws, how's it gawn?";
                    case "Duncan": 
                        return "Hapnin Fanta Pubes?";
                    case "James": 
                        return "Orite Gaffer!";
                    case "Stuart": 
                        return "Hiya Gayboy!xx";
                    case "Chris": 
                        return "Dear Hearts bastard,";
                    default:
                        return "Heeey good lookin',"
                }
            }
        }
    }
</script>
