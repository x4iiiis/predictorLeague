<template>
    <div class="mr-0 ml-auto my-2">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-9">
                        Legend
                    </div>
                    <div class="col-3 text-right">
                        <a v-if="!show" class="btn-sm btn-round btn-warning mr-0 ml-auto" @click="showOrHide()">Show</a>
                        <a v-if="show" class="btn-sm btn-round btn-warning mr-0 ml-auto" @click="showOrHide()">Hide</a>
                    </div>
                </div>
            </div>

            <div v-if="show" class="card-body">
                <table class="table" style="vertical-align:middle">
                    <!-- <th>Legend</th> -->
                    <tr>
                        <td class="text-center text-success">Green Text</td>
                        <td class="pl-3">Correct score</td>
                    </tr>
                    <tr>
                        <td class="text-center" style="color:#f6993f">Orange Text</td>
                        <td class="pl-3">Wrong score, correct outcome</td>
                    </tr>
                    <tr>
                        <td class="text-center text-success">*</td>
                        <td class="pl-3">Correct outcome AET / Pens</td>
                    </tr>
                    <tr>
                        <td class="text-center">*</td>
                        <td class="pl-3">Wrong outcome AET / Pens</td>
                    </tr>
                </table>
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
                show: false
            }
        },
        methods: {
            showOrHide() {
                this.show = !this.show;
            }
        }
    }
</script>
