<template>
  <div class="container">
    <div class="row justify-content-center">
        
        <div class="col-12 col-md-6">
            <!-- Login Vue Component -->
            <Login />
        </div>
        
        <div class="col-md-7">
            <!-- Announcement Vue Commponent -->
            <!-- <Announcement></Announcement> -->
            
            <!-- League Table Vue Component -->
            <League-Table />

            <!-- Rules Vue Component -->
            <Rules />

            <!-- Key Vue Component -->
            <Key />
        </div>


        <div class="col-md-5">
            <!-- Fixtures Vue Component --> 
            <Fixtures class="my-2" />

            <!-- Results Vue Component -->
            <Results />
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
import LeagueTable from '../components/LeagueTable';
import Rules from '../components/Rules';
import Key from '../components/Key';
import Fixtures from '../components/Fixtures';
import Results from '../components/Results';

export default {
    components: {
        Login,
        Announcement,
        LeagueTable,
        Rules,
        Key,
        Fixtures,
        Results
    }
}
</script>

