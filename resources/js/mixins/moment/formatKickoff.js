import moment from 'moment-timezone';

export default {
	methods: {
		kickoffFormat(time) {
			return moment(time).format("dddd Do MMMM YYYY HH:mm"); 
		}
	}
}
