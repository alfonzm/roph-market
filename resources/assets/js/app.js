require('./bootstrap')

window.Vue = require('vue')

const app = new Vue({
    el: '#app',
    components: {
		'latest-stalls': require('./components/LatestStalls.vue'),
		'latest-items': require('./components/LatestItems.vue'),
		'stall-item-search': require('./components/StallItemSearch.vue'),
		'create-stall': require('./components/CreateStall.vue'),
		'igns-form': require('./components/IgnsForm.vue'),
		
		'stall-list': require('./components/presentational/StallList.vue'),
		'stall-item-list': require('./components/presentational/StallItemList.vue'),
    }
});