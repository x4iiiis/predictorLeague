<template>
    <div>
        <PastSeason v-if="season == '2019/20'">
            <template v-slot:table v-if="table == 'League Table'">
                <table class="table table-hover"><tr style="text-align: center;"><th></th> <th>Points</th> <th>Correct Score</th> <th>Correct Outcome</th></tr> <!----> <tr style="text-align: center;"><td>Duncan McPherson</td> <td>449</td> <td>63</td> <td>260</td></tr><tr style="text-align: center;"><td>Ryan O'Flaherty</td> <td>448</td> <td>54</td> <td>286</td></tr><tr style="text-align: center;"><td>Darren Wilson</td> <td>429</td> <td>52</td> <td>273</td></tr><tr style="text-align: center;"><td>James Devlin</td> <td>409</td> <td>53</td> <td>250</td></tr><tr style="text-align: center;"><td>Chris Fletcher</td> <td>403</td> <td>47</td> <td>262</td></tr><tr style="text-align: center;"><td>Stuart Williamson</td> <td>391</td> <td>46</td> <td>253</td></tr><tr style="text-align: center;"><td>Cheree Iannelli</td> <td>234</td> <td>28</td> <td>150</td></tr></table>
            </template>
            <template v-slot:table v-else-if="table == 'Stats'">
                <table class="table table-hover"><tr style="text-align: center;"><th></th> <th>Predictions</th> <th>Correct Score %</th> <th>Correct Outcome %</th></tr> <!----> <tr style="text-align: center;"><td>Duncan McPherson</td> <td>692</td> <td>9.10</td> <td>37.57</td></tr><tr style="text-align: center;"><td>Ryan O'Flaherty</td> <td>719</td> <td>7.51</td> <td>39.78</td></tr><tr style="text-align: center;"><td>Darren Wilson</td> <td>701</td> <td>7.42</td> <td>38.94</td></tr><tr style="text-align: center;"><td>James Devlin</td> <td>696</td> <td>7.61</td> <td>35.92</td></tr><tr style="text-align: center;"><td>Chris Fletcher</td> <td>654</td> <td>7.19</td> <td>40.06</td></tr><tr style="text-align: center;"><td>Stuart Williamson</td> <td>660</td> <td>6.97</td> <td>38.33</td></tr><tr style="text-align: center;"><td>Cheree Iannelli</td> <td>386</td> <td>7.25</td> <td>38.86</td></tr></table>
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
