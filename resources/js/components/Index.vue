<template>
    <div>
        <Header :user="user" v-on:account="sidebarStatusFlip"/>

        <MyAccount :show="showSidebar" v-on:account="sidebarStatusFlip"/>


        <div class="container" :style="showSidebar ? 'opacity:0.3;' : ''">
            <div class="row justify-content-center">
                
                <div v-if="!ready" class="col-1 mx-auto">
                    <Spinner />
                </div>
                
                <!-- <Announcement /> -->

                <!-- <div v-if="!user.hasVoted && ready" class="col-10 mx-auto">
                    <PollingStation :user="user" @voted="closePollingStation" />
                </div> -->

                <!-- <div class="col-10 mx-auto">
                    <SalesPitch />
                </div> -->


                <div v-if="user.hasVoted && ready" class="col-md-7">
                    <!-- <Announcement></Announcement> -->
                    <League-Table :users="usersForLeague" />
                    <Rules />
                    <Key />
                    <Stats :users="usersForLeague" />
                    <Archive />
                </div>

                <div v-if="user.hasVoted && ready" class="col-md-5">
                    <Fixtures class="my-2" :users="users" :user="user"/>
                    <Results :users="users" />
                </div>

            </div>
        </div>
        <Footer />
    </div>
</template>

<script>
import Announcement from '../components/Announcement';
import PollingStation from '../components/democracy/PollingStation';
import LeagueTable from '../components/LeagueTable';
import Rules from '../components/Rules';
import Key from '../components/Key';
import Stats from '../components/Stats';
import Archive from '../components/archive/Archive';
import Fixtures from '../components/Fixtures';
import Results from '../components/Results';
import Spinner from '../components/Spinner.vue';
import Header from '../components/nav/Header';
import Footer from '../components/nav/Footer';
import MyAccount from '../components/accounts/MyAccount';

import SalesPitch from '../components/terms/RegistrationSalesPitch'

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
            showSidebar: false,
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
        },
        sidebarStatusFlip() {
            this.showSidebar = !this.showSidebar;
        }
    },
    components: {
        Announcement,
        PollingStation,
        LeagueTable,
        Rules,
        Key,
        Stats,
        Archive,
        Fixtures,
        Results,
        Spinner,
        Header,
        Footer,
        MyAccount,

        SalesPitch
    }
}
</script>

