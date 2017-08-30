require('./bootstrap');

window.Vue = require('vue');

// Vue.component('home', require('./components/Home.vue'));

const app = new Vue({
    el: '#app',
    components: {
    	'home': require('./components/Home.vue'),
    	'item-search': require('./components/ItemSearch.vue'),
		'stall-list': require('./components/StallList.vue'),
		'create-stall': require('./components/CreateStall.vue'),
    }
});