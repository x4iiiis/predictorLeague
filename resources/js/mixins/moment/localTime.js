import moment from 'moment-timezone';

export default {
	methods: {
		localTime(time) {
			return moment.tz(time, 'Europe/London').local()
		}
	}
}
