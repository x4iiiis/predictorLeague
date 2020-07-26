<template>
    <div>
        <PastSeason v-if="season == '2019/20'">
            <template v-slot:table v-if="table == 'League Table'">
                <table class="table table-hover"><tr style="text-align: center;"><th></th> <th>Points</th> <th>Correct Score</th> <th>Correct Outcome</th></tr> <!----> <tr style="text-align: center;"><td>Ryan O'Flaherty</td> <td>456</td> <td>55</td> <td>291</td></tr><tr style="text-align: center;"><td>Duncan McPherson</td> <td>455</td> <td>64</td> <td>263</td></tr><tr style="text-align: center;"><td>Darren Wilson</td> <td>437</td> <td>54</td> <td>275</td></tr><tr style="text-align: center;"><td>James Devlin</td> <td>417</td> <td>54</td> <td>255</td></tr><tr style="text-align: center;"><td>Chris Fletcher</td> <td>413</td> <td>49</td> <td>266</td></tr><tr style="text-align: center;"><td>Stuart Williamson</td> <td>400</td> <td>48</td> <td>256</td></tr><tr style="text-align: center;"><td>Cheree Iannelli</td> <td>234</td> <td>28</td> <td>150</td></tr></table>
            </template>
            <template v-slot:table v-else-if="table == 'Stats'">
                <table class="table table-hover"><tr style="text-align: center;"><th></th> <th>Predictions</th> <th>Correct Score %</th> <th>Correct Outcome %</th></tr> <!----> <tr style="text-align: center;"><td>Ryan O'Flaherty</td> <td>729</td> <td>7.54</td> <td>39.92</td></tr><tr style="text-align: center;"><td>Duncan McPherson</td> <td>702</td> <td>9.12</td> <td>37.46</td></tr><tr style="text-align: center;"><td>Darren Wilson</td> <td>711</td> <td>7.59</td> <td>38.68</td></tr><tr style="text-align: center;"><td>James Devlin</td> <td>706</td> <td>7.65</td> <td>36.12</td></tr><tr style="text-align: center;"><td>Chris Fletcher</td> <td>664</td> <td>7.38</td> <td>40.06</td></tr><tr style="text-align: center;"><td>Stuart Williamson</td> <td>670</td> <td>7.16</td> <td>38.21</td></tr><tr style="text-align: center;"><td>Cheree Iannelli</td> <td>386</td> <td>7.25</td> <td>38.86</td></tr></table>
            </template>
        </PastSeason>
        
        <PastSeason v-if="season == '2020/21'">
            <template v-slot:table>
                
            </template>
            <template v-slot:table>

            </template>
        </PastSeason>

    </div>
</template>

<script>
    import PastSeason from '../archive/PastSeason'

    export default {
        props: [
            'season',
            'table'
        ],
        components: {
            PastSeason
        }
    }
</script>
