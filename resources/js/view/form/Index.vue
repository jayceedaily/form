<template>
<div class="container">
    <div class="columns">
        <div class="column">
            <!-- <button class="button is-primary">Create form</button> -->
            <router-link href="#" class="button is-primary" to='form/create'>Create form</router-link>
            <button @click="showFilterModal=true" class="button is-pulled-right"><i class="material-icons">filter_list</i></button>

        </div>
    </div>
    <div class="columns">
        <div class="column">
            <div class="card pt-15">
                <the-table/>
            </div>
        </div>
    </div>
    <filter-modal v-if="showFilterModal" @close="showFilterModal=false"></filter-modal>
</div>
</template>

<script>
import TheTable from './TheTable';
import FilterModal from './FilterModal';
import { mapActions } from 'vuex';
export default {
    name: 'Form',
    components:{
        TheTable,
        FilterModal
    },
    data: function() {
        return {
            showFilterModal: false
        }
    },
    watch: {
        '$route.query' : {

            handler() {

                let filters = this.$route.query;

                this.formSetFilter(filters)

                this.loadForms(filters)
            },
            immediate: true
        }
    },

    created: function() {

        let filters = this.$route.query;

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
