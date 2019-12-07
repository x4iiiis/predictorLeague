<template>
    <div class="mr-0 ml-auto my-2">
        <div class="card">
            <div class="card-header">Legend</div>

            <div class="card-body">
                <table class="table" style="vertical-align:middle">
                    <th>Legend</th>
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
                        <td class="pl-3">Correct outcome AET/Pens</td>
                    </tr>
                    <tr>
                        <td class="text-center">*</td>
                        <td class="pl-3">Wrong outcome AET/Pens</td>
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
        }
    }
</script>
