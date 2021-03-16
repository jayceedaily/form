<template>
    <tr>
        <td>{{form.name}}</td>
        <td>{{form.sheets_count}}</td>
        <td>{{moments(form.created_at).fromNow()}}</td>
        <td>
            <div class="columns is-pulled-right">
                <div class="column">

                    <my-dropdown>
                        <template v-slot:trigger>
                            <button class="button is-small">
                                <i class="material-icons"  aria-haspopup="true" aria-controls="dropdown-menu">more_horiz</i>
                            </button>
                        </template>

                        <template  v-slot:menu >
                                <router-link href="#" class="dropdown-item" :to="'form/' + form.id">View</router-link>
                                <a class="dropdown-item">Delete</a>
                        </template>

                    </my-dropdown>
                </div>
            </div>
        </td>
    </tr>
</template>

<script>
import moment from 'moment';

export default {
    name: 'TheTableRow',
    props: ['form'],
    methods: {
        moments: function(value) {
            return moment(value);
        }
    }
}
</script>

<style>

</style>
