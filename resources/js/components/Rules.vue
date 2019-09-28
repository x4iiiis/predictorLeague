<template>
    <div class="mr-0 ml-auto my-2">
        <div class="card">
            <div class="card-header">Rules</div>

                <div class="card-body">
                    <ul>
                        <li><p>Correct Score: 3pts</p></li>
                        <li><p>Wrong Score w/Correct Outcome: 1pt</p></li>
                        <hr>
                        <li><p>Cup games are based on 90 minutes</p></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Rules Component mounted.')
        }
    }
</script>
