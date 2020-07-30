<template>

    <VueCountDown
      @end="$emit('end')"
      ref="vueCountDown"
      :time="formattedDate"
      tag="div"
    >
      <template slot-scope="props">
        <slot v-bind:time="props"></slot>
      </template>
    </VueCountDown>

</template>

<script>
    import VueCountDown from '@chenfengyuan/vue-countdown'
    import TimeUntilDateInMilliseconds from '../../mixins/moment/timeUntilDateInMilliseconds'

    export default {
        props: {
            date: {
                required: true
            }
        },
        mixins: [ TimeUntilDateInMilliseconds ],
        computed: {
            formattedDate() {
                return this.timeUntilDateInMilliseconds(this.date)
            }
        },
        components: {
            VueCountDown
        }
    }
</script>
