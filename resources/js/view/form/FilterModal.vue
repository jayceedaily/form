<template>
    <my-modal open @close="$emit('close')">
        <div class="card pa-100">
            <my-autocomplete v-model="filter.created_by" endpoint="/user"></my-autocomplete>
            <button class="button is-primary" @click="applyFilters">Apply</button>
        </div>

    </my-modal>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'
import {router} from '../../router'

export default {
    name: 'FilterModal',
    data: function() {

        return {
            filter: {
                created_by: null
            }
        }
    },

    computed: {
        ...mapGetters({
            formQueries: 'form/queries',
        }),
    },
    watch: {
    },
    methods: {
        ...mapActions({
            formSetQueries: 'form/setQueries',
            loadForms:'form/load',

        }),

        applyFilters()
        {
            let queries = this.formQueries;

            // This needs to be converted into a parser
            Object.entries(this.filter).forEach(item => {
                queries["filter["+ item[0] + "]"] = item[1];
            });

            this.formSetQueries(queries);

            router.push({
                ...router.currentRoute,
                query: queries
            }).catch(()=> {});

            this.loadForms(queries)
        }
    }
}
</script>

<style>

</style>
