import moment from 'moment-timezone';

export default {
    methods: {
        timeUntilDateInMilliseconds(date) {

            let dateInstance = moment.tz(date, "Europe/London");
            // console.log(moment.duration(dateInstance.local().diff(moment())).asMilliseconds());
            return moment.duration(dateInstance.local().diff(moment())).asMilliseconds();
        }
    }
}