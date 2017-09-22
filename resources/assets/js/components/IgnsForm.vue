<template>
    <div class="igns-form">
        <div>
            <form @submit.prevent="submitForm">
                <input v-model="ignToAdd.ign" name="ign" type="text" placeholder="Character Name" required />
                <select v-model="ignToAdd.server_id" name="server_id" class="capitalized">
                    <option v-for="server in servers" :value="server.id">{{ server.name }}</option>
                </select>
                <input type="submit" value="Add IGN" :disabled="loading" />
            </form>
        </div>

        <template v-if="Object.keys(localIgns).length <= 0">
            <p>
                You have no IGNs.
            </p>
        </template>
        <template v-else v-for="(serverIgns, serverName) in localIgns">
            <template v-if="serverIgns.length > 0">
                <h5>{{ serverName }}</h5>
                <table class="igns">
                    <tbody>
                        <tr v-for="(ign, index) in serverIgns">
                            <td class="ign"> 
                                {{ ign.ign }}
                            </td>
                            <td>
                                <a href="#" @click.prevent="deleteIgn(ign.id, serverName, index)">[delete]</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </template>

        </template>
    </div>
</template>

<script>
import _ from 'lodash'
import Constants from './Constants'
import Cookies from 'cookies-js'

export default {
    props: ['igns', 'userId'],
    data() {
        return {
            // grouped IGNs
            localIgns: {},

            loading: false,
            ignToAdd: {
                ign: null,
                server_id: Cookies.get('server') || Constants.servers[0].id,
            },
            servers: Constants.servers
        }
    },
    beforeMount() {
        this.localIgns = this.igns.length == 0 ? {} : this.igns
    },
    computed: {
    },
    methods: {
        submitForm() {
            this.loading = true
            axios.post(`/api/v1/users/${this.userId}/igns`, {
                'ign': this.ignToAdd.ign,
                'server_id': this.ignToAdd.server_id,
            }).then((res) => {
                this.loading = false
                this.ignToAdd.ign = null

                if(!(res.data.server.name in this.localIgns)) {
                    this.localIgns[res.data.server.name] = []
                }
                this.localIgns[res.data.server.name].push(Object.assign({}, {
                    'ign': res.data.ign,
                    'id': res.data.id
                }))
            })
        },
        deleteIgn(id, server, index) {
            axios.delete(`/api/v1/users/${this.userId}/igns/${id}`, {}).then((res) => {
                if(res.data.success) {
                    if(!(server in this.localIgns)) {
                        this.localIgns[server] = []
                    }
                    this.localIgns[server].splice(index, 1)
                }
            }).catch((err) => {
                alert(err.response.data.message)
            })
        }
    }
}
</script>
