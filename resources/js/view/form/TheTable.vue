<template>
    <table class="table is-fullwidth">
        <thead>
            <tr>
                <th>
                    <a @click="handleSort('name')" class="has-text-grey-light">Name  <i v-if="sort[sortables.name] != null" class="material-icons" style="vertical-align:middle">{{sort[sortables.name] == 'ASC' ? 'keyboard_arrow_up' : 'keyboard_arrow_down'}}</i></a>
                </th>
                <th class="has-text-grey-light">Responses</th>
                <th>
                    <a @click="handleSort('created_at')" class="has-text-grey-light">Date Created  <i v-if="sort[sortables.created_at] != null" class="material-icons" style="vertical-align:middle">{{sort[sortables.created_at] == 'ASC' ? 'keyboard_arrow_up' : 'keyboard_arrow_down'}}</i></a>
                </th>
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
                        @pageChange="handlePageChange"
                        @limitChange="handleLimitChange"

                        />
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

            sortables: {
                name: 0,
                created_at: 0,
            }
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

        handleLimitChange(limit) {
            let filters = this.formFilters;

            filters.limit = limit

            this.formSetFilter(filters);
        },

        handleSort(sortVariable) {


            // reset values
            Object.keys(this.sortables).forEach((key, value) => {
                if(key != sortVariable) {
                    this.sortables[key] = 0
                }
            })

            if(this.sortables[sortVariable] == 2) {
                this.sortables[sortVariable] = 0;
            } else {
                this.sortables[sortVariable] = this.sortables[sortVariable] + 1;
            }

            let _sort = {};

            _sort["sort["+ sortVariable + "]"] = this.sort[this.sortables[sortVariable]];

            this.formSetFilter(_sort);
        }
    }
}
</script>

<style>

</style>
