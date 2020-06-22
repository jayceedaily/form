<template>
    <tr>
        <td>{{form.name}}</td>
        <td>{{form.sheets_count}}</td>
        <td>
            <my-dropdown>
                <template v-slot:trigger>
                    <button class="button" aria-haspopup="true" aria-controls="dropdown-menu">
                        <i class="material-icons">more_horiz</i>
                    </button>
                </template>

                <template  v-slot:menu >
                        <router-link href="#" class="dropdown-item" :to="'form/' + form.id">View</router-link>
                        <a class="dropdown-item">Delete</a>
                </template  v-slot:menu>

            </my-dropdown>
        </td>
    </tr>
</template>

<script>
export default {
    name: 'TheTableRow',
    props: ['form']
}
</script>

<style>

</style>
    