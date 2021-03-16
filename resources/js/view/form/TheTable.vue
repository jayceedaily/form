<template>
    <table class="table is-fullwidth">
        <thead>
            <tr>
                <th>
                    <a @click="handleTitleSort" class="has-text-grey-light">Name  <i v-if="sort[titleSort] != null" class="material-icons" style="vertical-align:middle">{{sort[titleSort] == 'ASC' ? 'keyboard_arrow_up' : 'keyboard_arrow_down'}}</i></a>
                </th>
                <th>Responses</th>
                <th>Date Created</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <the-table-row v-for="form in forms" :key="form.id" :form="form"/>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="100%">
                    <my-paginate :currentPage="formCurrentPage"
                        :lastPage="formLastPage"
                        :totalItem="formTotalItem"
                        :from="formItemFrom"
                        :to="formItemTo"
                        @pageChange="handlePageChange"/>
                </td>
            </tr>
        </tfoot>
    </table>
</template>

<script>
import TheTableRow from './TheTableRow';
import { mapActions, mapGetters } from 'vuex';
export default {
    name: 'TheTable',

    data: function() {
        return {
            sort: [null, 'ASC', 'DESC'],

            titleSort: 0,
        }
    },

    computed:{
        ...mapGetters({
            forms:'form/items',
            formCurrentPage:'form/currentPage',
            formLastPage:'form/lastPage',
            formTotalItem:'form/totalItem',
            formItemFrom: 'form/itemFrom',
            formItemTo: 'form/itemTo',
            formFilters: 'form/filters',
        }),
    },

    watch: {
        formFilters: {
            handler(value) {
                console.log('fitler change');
            }
        }
    },

    methods: {

        ...mapActions({
            formLoad: 'form/load',
            formSetFilter: 'form/setFilter',
        }),

        handlePageChange(page) {
            let filters = this.formFilters;

            filters.page = page

            this.formSetFilter(filters);
        },

        handleTitleSort() {
            if(this.titleSort == 2) {
                this.titleSort = 0;
            } else {
                this.titleSort = this.titleSort+1;
            }

            this.formSetFilter({ "sort[name]": this.sort[this.titleSort]} );
        }
    }
}
</script>

<style>

</style>
