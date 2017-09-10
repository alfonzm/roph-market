require('./bootstrap');

window.Vue = require('vue');

const app = new Vue({
    el: '#app',
    components: {
		'latest-stalls': require('./components/LatestStalls.vue'),
		'latest-items': require('./components/LatestItems.vue'),
		'stall-search': require('./components/RoItemStallSearch.vue'),
		'create-stall': require('./components/CreateStall.vue'),
		'stall-item-list': require('./components/presentational/StallItemList.vue'),
    }
});