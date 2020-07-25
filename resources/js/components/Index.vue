<template>
  <div class="container">
    <div class="row justify-content-center">
        
        <!-- <div class="col-12 col-md-6"> -->
            <!-- Login Vue Component -->
            <!-- <Login /> -->
        <!-- </div> -->

        <div v-if="!user.hasVoted && ready" class="col-10 mx-auto">
            <!-- Polling Station -->
            <PollingStation :user="user" @voted="closePollingStation" />
        </div>
        
        <div v-if="user.hasVoted" class="col-md-7">
            <!-- Announcement Vue Commponent -->
            <!-- <Announcement></Announcement> -->

            
            <!-- League Table Vue Component -->
            <League-Table :users="usersForLeague" />

            <!-- Rules Vue Component -->
            <Rules />

            <!-- Key Vue Component -->
            <Key />

            <!-- User Stats Component -->
            <Stats :users="usersForLeague" />
        </div>


        <div v-if="user.hasVoted" class="col-md-5">
            <!-- Fixtures Vue Component --> 
            <Fixtures class="my-2" :users="users" :user="user"/>

            <!-- Results Vue Component -->
            <Results :users="users" />
        </div>

        <!-- <p>Down for some gentle TLC.</p>
        <br>
        <p>Check back soon!</p> -->
    </div>
</div>
</template>

<script>
import Login from '../components/Login';
import Announcement from '../components/Announcement';
import PollingStation from '../components/democracy/PollingStation';
import LeagueTable from '../components/LeagueTable';
import Rules from '../components/Rules';
import Key from '../components/Key';
import Stats from '../components/Stats';
import Fixtures from '../components/Fixtures';
import Results from '../components/Results';

export default {
    async mounted() {
        await this.userCheck();

        var self = this;
        setTimeout( function() {
            self.getUsers();
        }, 1000);
    },
    data() {
        return {
            user: [],
            users: [],
            usersForLeague: [],
            ready: false
        }
    },
    methods: {
        userCheck() {
            axios
                .get('/whoami')
                .then(res => {
                    this.user = res.data[1];
                })
                .catch(err => {
                    console.log(err.response);
                })
        },
        getUsers() {
            axios
                .get('/getusers')
                .then(res => {
                    this.usersForLeague = res.data[1];
                    this.users = res.data[3];
                    this.ready = true;
                })
                .catch(err => {
                    console.log(err.response);
                })
        },
        closePollingStation() {
            var self = this;
            setTimeout( function() {
                self.user.hasVoted = true;
            }, 3000);
        }
    },
    components: {
        Login,
        Announcement,
        PollingStation,
        LeagueTable,
        Rules,
        Key,
        Stats,
        Fixtures,
        Results
    }
}
</script>

