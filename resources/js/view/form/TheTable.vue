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

    mounted() {
        let filters = this.getQueryString('form_filters');
    },

    methods: {

        ...mapActions({
            formLoad: 'form/load',
            formSetFilter: 'form/setFilter',
        }),

        handlePageChange(page) {

            this.formSetFilter({page});

            // this.formLoad();
        },

        getQueryString(name, url = window.location.href) {
            name = name.replace(/[\[\]]/g, '\\$&')
            var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
                results = regex.exec(url)
            if (!results) return null
            if (!results[2]) return ''
            return decodeURIComponent(results[2].replace(/\+/g, ' '))
        }
    }
}
</script>

<style>

</style>
