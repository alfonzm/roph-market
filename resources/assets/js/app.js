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
		'latest-items': require('./components/LatestItems.vue'),
		'stall-item-search': require('./components/StallItemSearch.vue'),
		'stall-form': require('./components/StallForm.vue'),
		'igns-form': require('./components/IgnsForm.vue'),
		
		'stall-list': require('./components/presentational/StallList.vue'),
		'stall-item-list': require('./components/presentational/StallItemList.vue'),
		'time-ago-date': require('./components/presentational/TimeAgoDate.vue'),
    },
    mixins: [helpers]
});