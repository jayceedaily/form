<template>
<div class="container">
    <div class="columns">
        <div class="column">
            <!-- <button class="button is-primary">Create form</button> -->
            <router-link href="#" class="button is-primary" to='form/create'>Create form</router-link>

        </div>
    </div>
<div class="columns">
    <div class="column">
        <div class="card">
            <the-table/>
        </div>
    </div>
</div>
</div>
</template>

<script>
import TheTable from './TheTable';
import { mapActions } from 'vuex';
export default {
    name: 'Form',
    components:{
        TheTable
    },
    data: function() {
        return {

        }
    },


    created: function() {

        let filters = this.$route.query;

        this.formSetFilter(filters)
    },
    methods: {
        ...mapActions({
            loadForms:'form/load',
            formSetFilter: 'form/setFilter'
        }),
    }
}
</script>

<style>

</style>
