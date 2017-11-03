<template>
    <div>
        <!-- Username -->
        <div>
            <h4>
                Username
            </h4>
            <input id="name" type="text" name="name" :value="oldName" required autofocus size="30">
            <span v-if="errorName" class="error">
                {{ errorName }}
            </span>
            <div class="muted">
                <small style="color: red">NOTE: Do not use your Ragnarok Online login credentials!</small>
            </div>
        </div>

        <!-- Password -->
        <div>
            <h4>
                Password
            </h4>
            <input id="password" type="password" class="form-control" name="password" required size="30">

            <span class="error" v-if="errorPassword">
                {{ errorPassword }}
            </span>
        </div>

        <!-- Email -->
        <div>
            <h4>
                E-Mail Address
            </h4>
            <input id="email" type="email" name="email" :value="oldEmail" required size="30">
            <span class="error" v-if="errorEmail">
                {{ errorEmail }}
            </span>
        </div>

        <!-- IGN -->
        <div>
            <h4>
                IGN
            </h4>
            <input id="ign" type="text" name="ign" :value="oldIgn" required size="30">
            <span class="error" v-if="errorIgn">
                {{ errorIgn }}
            </span>
            <div class="muted">
                <small>At least one in-game name is required so other players can PM you. You can add or edit IGNs later.</small>
            </div>
        </div>

        <!-- Server IGN -->
        <div>
            <h4>
                Server
            </h4>
            <select name="server_id">
                <option value="1" selected>Loki</option>
                <option value="2">Thor</option>
                <option value="3">Chaos</option>
            </select>
            <div class="muted"><small>You can switch servers later.</small></div>
        </div>

        <!-- Submit -->
        <p>
            <button type="submit">
                Create account
            </button>
        </p>
    </div>
</template>

<script>
import _ from 'lodash'
import Constants from './Constants'
import Cookies from 'cookies-js'

export default {
    props: ['oldName',
            'oldEmail',
            'oldIgn',
            'errorName',
            'errorEmail',
            'errorIgn',
            'errorPassword',
            ],
    data() {
        return {}
    },
    computed: {
    },
    methods: {}
}
</script>
