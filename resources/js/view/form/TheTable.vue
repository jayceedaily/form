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
                <td colspan="100%"></td>
            </tr>
        </tfoot>
    </table>
</template>

<script>
import TheTableRow from './TheTableRow';
import { mapGetters } from 'vuex';
export default {
    name: 'TheTable',
    computed:{
        ...mapGetters({forms:'form/items'}),
    }
}
</script>

<style>

</style>
