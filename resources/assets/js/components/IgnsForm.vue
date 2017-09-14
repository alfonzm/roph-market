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
        <template v-else>
            <ul>
                <li v-for="(ign, index) in localIgns">
                    {{ ign.ign }} — {{ ign.server.name }} <a href="#" @click.prevent="deleteIgn(ign.id, index)">[delete]</a>
                </li>
            </ul>
        </template>

    </div>
</template>

<script>

export default {
    props: ['igns', 'userId'],
    data() {
        return {
            localIgns: [],
            loading: false,
            ignToAdd: {
                ign: null,
                server_id: 1
            }
        }
    },
    beforeMount() {
        this.localIgns = this.igns
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
                this.localIgns.push(res.data)
            })
        },
        deleteIgn(id, index) {
            axios.delete(`/api/v1/users/${this.userId}/igns/${id}`, {}).then((res) => {
                if(res.data.success) {
                    this.localIgns.splice(index, 1)
                }
            })
        }
    }
}
</script>
