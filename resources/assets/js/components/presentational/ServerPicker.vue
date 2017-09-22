<template>
    <div class="server-picker" v-on-clickaway="close">
        <a href="#" @click="toggle">
        	<template v-if="server">
	        	{{ server.name }}
        	</template>
        	<template v-else>
        		select a server
        	</template>
        	&nbsp;&nbsp;<i class="fa fa-caret-down"></i>
        </a>
        <div :class="{active: show}" class="server-list">
    		<a
				v-for="server in servers"
        		href="#"
        		@click.prevent="selectServer(server)"
        		>
    			{{ server.name }}
    		</a>
        </div>
    </div>
</template>

<script>
import _ from 'lodash'
import Cookies from 'cookies-js'
import { mixin as clickaway } from 'vue-clickaway'
import Constants from '../Constants'

export default {
	mixins: [ clickaway ],
	data() {
		return {
			show: false,
			server: { id: null, name: null },
			servers: Constants.servers
		}
	},
	mounted() {
		this.server = _.find(this.servers, (o) => Cookies.get('server') == o.id)
	},
	methods: {
		toggle() {
			this.show = !this.show
		},
		close() {
			this.show = false
		},
		selectServer(server) {
			location.reload()
			// this.show = false
			// this.server = server
			Cookies.set('server', server.id, { expires: Infinity })
		}
	}
}
</script>