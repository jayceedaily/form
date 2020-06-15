<template>
    <div class="field">
        <p><label>{{label}}</label></p>
        <div class="control">
            <input :type="type ? type : 'text'" class="input" @input="handleInput" v-model="component_value" :required="required">
        </div>
        <span class="has-text-danger">{{errors}}</span>
    </div>
</template>

<script>
export default {
    name: 'MyInput',
    props: ['value', 'label', 'errors', 'type', 'required'],
    data: function() {
        return {
            component_value: this.value ? this.value : '',
        }
    },
    methods:{
        handleInput: function() {
            this.$emit('input', this.component_value);
        }
    }

}
</script>

<style>

</style>
