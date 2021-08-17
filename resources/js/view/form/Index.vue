<template>
<div class="container">
    <div class="columns">
        <div class="column">
            <form @submit.prevent="handleSearch">
                <p class="control has-icons-left">
                    <!-- <input class="input" type="email" placeholder="Email"> -->
                    <input type="text" v-model="searchQuery" name="" id="" class="input">

                    <span class="icon is-small is-left">
                        <i class="material-icons">search</i>
                    </span>
                </p>
            </form>
        </div>
    </div>
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
import { mapActions, mapGetters } from 'vuex';
import {router} from '../../router'

export default {
    name: 'Form',
    components:{
        TheTable,
        FilterModal
    },
    data: function() {
        return {
            showFilterModal: false,
            searchQuery: "",
        }
    },
    watch: {
        '$route.query' : {

            handler() {

                let queries = this.$route.query;

                queries.autoload = ['author'];
                queries.sort = [];

                this.formSetHiddenQueries(queries)

                this.loadForms(queries)
            },
            immediate: true
        }
    },
    computed: {
        ...mapGetters({
            formQueries: 'form/queries',
        })
    },

    created: function() {

        let queries = this.$route.query;

        this.searchQuery = this.formQueries.search

    },
    methods: {
        ...mapActions({
            loadForms:'form/load',
            formSetQueries: 'form/setQueries',
            formSetHiddenQueries: 'form/setHiddenQueries',
        }),

        handleSearch() {
            let queries = {search: this.searchQuery};

            this.formSetQueries(queries);

            // this.loadForms();
            router.push({
                ...router.currentRoute,
                query: queries
            }).catch(()=> {});
        },

        handleSearchInput(value) {

            let _queries = {search: value.target.value};

            this.formSetQueries(_queries)
        }
    }
}
</script>

<style>
.fade-enter-active,
.fade-leave-active {
  transition: opacity .4s linear;
}

.fade-enter,
.fade-leave-to {
  opacity: 0;
}

.pop-enter-active,
.pop-leave-active {
  transition: transform 0.4s cubic-bezier(0.5, 0, 0.5, 1), opacity 0.4s linear;
}

.pop-enter,
.pop-leave-to {
  opacity: 0;
  transform: scale(0.3) translateY(-50%);
}
</style>
