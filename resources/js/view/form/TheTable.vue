<template>
    <table class="table is-fullwidth is-hoverable">
        <thead>
            <tr>
                <th>
                    <a @click="handleSort('name')" class="has-text-grey-light">Name  <i v-if="sort[sortables.name] != null" class="material-icons" style="vertical-align:middle">{{sort[sortables.name] == 'ASC' ? 'keyboard_arrow_up' : 'keyboard_arrow_down'}}</i></a>
                </th>
                <th class="has-text-grey-light">Responses</th>
                <th>
                    <a @click="handleSort('author.name')" class="has-text-grey-light">Author <i v-if="sort[sortables['author.name']] != null" class="material-icons" style="vertical-align:middle">{{sort[sortables["author.name"]] == 'ASC' ? 'keyboard_arrow_up' : 'keyboard_arrow_down'}}</i></a>
                </th>
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
                        :totalItem="formTotal"
                        :from="formItemFrom"
                        :to="formItemTo"
                        :limit="formPerPage"
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
import {router} from '../../router'

export default {
    name: 'TheTable',

    data: function() {
        return {
            sort: [null, 'ASC', 'DESC'],

            sortables: {
                name: 0,
                created_at: 0,
                "author.name": 0,
            }
        }
    },

    computed:{
        ...mapGetters({
            forms:'form/collection',
            formCurrentPage:'form/currentPage',
            formLastPage:'form/lastPage',
            formTotal:'form/total',
            formItemFrom: 'form/itemFrom',
            formItemTo: 'form/itemTo',
            formQueries: 'form/queries',
            formPerPage: 'form/perPage',
        }),
    },

    watch: {
        formQueries: {
            handler(value) {

            }
        }
    },

    methods: {

        ...mapActions({
            formLoad: 'form/load',
            formSetQueries: 'form/setQueries',
        }),

        handlePageChange(page) {
            let queries = this.formQueries;

            queries.page = page

            this.formSetQueries(queries);

            router.push({
                ...router.currentRoute,
                query: queries
            }).catch(()=> {});

        },

        handleLimitChange(limit) {

            let queries = this.formQueries;

            queries.limit = limit

            this.formSetQueries(queries);

            router.push({
                ...router.currentRoute,
                query: queries
            }).catch(()=> {});

            // this.formSetQueries({limit});
        },

        handleSort(sortVariable) {

            // console.log(sortVariable)
            let _queries = this.formQueries;

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

            _queries.page = 0;

            if(this.sort[this.sortables[sortVariable]] != null) {

                _queries["sort["+ sortVariable + "]"] = this.sort[this.sortables[sortVariable]];
            }

            else {
                delete _queries['sort[' + sortVariable + ']']
            }

            this.formSetQueries(_queries);

            router.push({
                ...router.currentRoute,
                query: _queries
            }).catch(()=> {});
        }
    }
}
</script>

<style>

</style>
