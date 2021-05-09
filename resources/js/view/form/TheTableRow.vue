<template>
    <tr>
        <td><p class="has-text-weight-bold">{{form.name}}</p></td>
        <td>{{form.sheets_count}}</td>
        <td> <div class="columns">
                <div class="column">
                    <p>{{form.author.name}}</p>
                    <p class="is-size-7 has-text-grey-light">{{form.author.email}}</p>
                </div>
            </div></td>
        <td>
            <div class="columns">
                <div class="column">
                    <p>{{moments(form.created_at).format('LT LL')}}</p>
                    <p class="is-size-7 has-text-grey-light">{{moments(form.created_at).fromNow()}}</p>
                </div>
            </div>
        </td>
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
