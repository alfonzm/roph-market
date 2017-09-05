require('./bootstrap');

window.Vue = require('vue');

const app = new Vue({
    el: '#app',
    components: {
    	'item-search': require('./components/ItemSearch.vue'),
		'stall-list': require('./components/StallList.vue'),
		'stall-search': require('./components/RoItemStallSearch.vue'),
		'create-stall': require('./components/CreateStall.vue'),
    }
});