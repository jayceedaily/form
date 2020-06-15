<template>

    <div v-if="!isLoading">
        <the-nav v-if="authenticated"/>
        <section class="section">
            <router-view v-if="authenticated"></router-view>
            <login-form v-else/>
        </section>

    </div>
    <div v-else>
        <div class="columns  is-vcentered" style="height:100vh">
            <div class="column">
                <div class="has-text-centered">
                    <my-loader color="has-background-primary"/>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import TheNav from './layout/TheNav';
import LoginForm from './auth/LoginForm'
import { mapGetters, mapActions } from 'vuex';
export default {
    name: 'App',
    data: function() {
        return {
            isLoading: true,
        }
    },
    components:{
        TheNav
    },
    computed: {
        ...mapGetters({authenticated:'auth/authenticated'})
    },

    created: function() {
        this.init().then((response) => {
            this.isLoading = false;
        });
    },

    methods: {
        ...mapActions({init:'auth/init'}),
    }
}
</script>

<style>

</style>
