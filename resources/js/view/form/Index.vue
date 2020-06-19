<template>
<div class="container">
    <div class="columns">
        <div class="column">
            <button class="button is-primary">Create form</button>
        </div>
    </div>
<div class="columns">
    <div class="column">
        <div class="card">
            <the-table/>
        </div>
    </div>
</div>
</div>
</template>

<script>
import TheTable from './TheTable';
import { mapActions } from 'vuex';
export default {
    name: 'Form',
    components:{
        TheTable
    },
    data: function() {
        return {

        }
    },
    created: function() {
        this.loadForms()
    },
    methods: {
        ...mapActions({loadForms:'form/load'}),
    }
}
</script>

<style>

</style>
