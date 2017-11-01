require('./bootstrap')
import moment from 'moment'
window.Vue = require('vue')

var helpers = {
	methods: {
		timeAgo: function(date) {
            return moment(date).fromNow();
        }
	}
}

const app = new Vue({
    el: '#app',
    components: {
		'latest-stalls': require('./components/LatestStalls.vue'),
		'latest-stall-items': require('./components/LatestStallItems.vue'),
		'stall-item-search': require('./components/StallItemSearch.vue'),
		'stall-form': require('./components/StallForm.vue'),
		'igns-form': require('./components/IgnsForm.vue'),
		'register-form': require('./components/RegisterForm.vue'),
		
		'server-picker': require('./components/presentational/ServerPicker.vue'),
		'stall-list': require('./components/presentational/StallList.vue'),
		'stall-item-list': require('./components/presentational/StallItemList.vue'),
		'time-ago-date': require('./components/presentational/TimeAgoDate.vue'),
		'alert-message': require('./components/presentational/AlertMessage.vue'),
    },
    mixins: [helpers]
});