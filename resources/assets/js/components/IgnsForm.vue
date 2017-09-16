<template>
    <div class="igns-form">
        <div>
            <form @submit.prevent="submitForm">
                <input v-model="ignToAdd.ign" name="ign" type="text" placeholder="Character Name" required />
                <select v-model="ignToAdd.server_id">
                    <option value="1" selected>Thor</option>
                    <option value="2">Loki</option>
                </select>
                <input type="submit" value="Add IGN" :disabled="loading" />
            </form>
        </div>

        <template v-if="localIgns.length <= 0">
            No igns found.
        </template>
        <template v-else v-for="(serverIgns, serverName) in localIgns">
            <template v-if="serverIgns.length > 0">
                <h5>{{ serverName }}</h5>
                <table>
                    <tbody>
                        <tr v-for="(ign, index) in serverIgns">
                            <td>
                                {{ ign.ign }}
                            </td>
                            <td>
                                <a v-if="ignsCount > 1" href="#" @click.prevent="deleteIgn(ign.id, serverName, index)">[delete]</a>
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

export default {
    props: ['igns', 'userId'],
    data() {
        return {
            localIgns: [],
            loading: false,
            ignToAdd: {
                ign: null,
                server_id: 1
            },
        }
    },
    beforeMount() {
        this.localIgns = this.igns
    },
    computed: {
        ignsCount() {
            return _.reduce(this.localIgns, (sum, serverIgns) => {
                return sum + serverIgns.length
            }, 0)
        }
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
                this.localIgns[res.data.server.name].push(Object.assign({}, res.data))
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
                console.log(err)
                alert(err.response.data.message)
            })
        }
    }
}
</script>
