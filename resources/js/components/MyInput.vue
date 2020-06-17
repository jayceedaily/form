<template>
    <div class="field">
        <p><label>{{label}}</label></p>
        <div class="control">
            <input :type="type" class="input" @input="handleInput" v-model="component_value" :required="required">
        </div>
        <span class="has-text-danger">{{errors}}</span>
    </div>

</template>

<script>
export default {
    name: 'MyInput',

    // props: ['value', 'label', 'errors', 'type', 'required'],
    props: {
        value: {
            required: false,
            type: String
        },
        label: {
            required: false,
            type: String,
            default: '',
        },
        errors: {
            required: false,
            type: String,
            default: null
        },

        type: {
            required: false,
            type: String,
            default: 'text'
        },

        required: {
            required: false,
            type: Boolean,
            default: false
        }
    },

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
