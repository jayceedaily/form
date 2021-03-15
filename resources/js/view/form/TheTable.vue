<template>
    <table class="table is-fullwidth">
        <thead>
            <tr>
                <th>Form Title</th>
                <th>Responses</th>
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
    computed:{
        ...mapGetters({
            forms:'form/items',
            formCurrentPage:'form/currentPage',
            formLastPage:'form/lastPage',
            formTotalItem:'form/totalItem'
        }),
    },
    methods: {

        ...mapActions({
            formLoad: 'form/load'
        }),

        handlePageChange(page) {
            this.formLoad("page="+page);
        }
    }
}
</script>

<style>

</style>
