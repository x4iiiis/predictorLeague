<template>
    <div class="card my-2">
        
        <div class="card-header">
            <div class="row">
                <div class="col-9">
                    Archive
                </div>
                <div class="col-3 text-right">
                    <a v-if="!show" class="btn-sm btn-round btn-warning mr-0 ml-auto" @click="showOrHide()">Show</a>
                    <a v-if="show" class="btn-sm btn-round btn-warning mr-0 ml-auto" @click="showOrHide()">Hide</a>
                </div>
            </div>
        </div>

        <div v-if="show" class="card-body">

            <p>Select a season to view the final league standings and stats</p>

            <div class="text-center mb-3">
                <select v-model="archiveSeason">
                    <option v-for="season in pastSeasons">{{ season }}</option>
                </select>
                
                <select v-model="tableOrStats">
                    <option>League Table</option>
                    <option>Stats</option>
                </select>
            </div>

            <PastSeasons :season="archiveSeason" :table="tableOrStats" />
        </div>
    </div>
</template>

<script>
    import PastSeasons from '../archive/PastSeasons'

    export default {
        data() {
            return {
                show: false,
                tableOrStats: 'League Table',
                archiveSeason: '2019/20',
                pastSeasons: [
                    '2019/20',
                ],
            }
        },
        methods: {
            showOrHide() {
                this.show = !this.show;
            }
        },
        components: {
            PastSeasons
        }
    }
</script>