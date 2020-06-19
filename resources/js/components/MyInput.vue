<template>
    <div class="field">
        <p><label>{{label}}</label></p>
        <div class="control">
            <input :type="type" class="input" v-on="listeners" :value="value" :required="required">
        </div>
        <span class="has-text-danger">{{errors}}</span>
    </div>

</template>

<script>
export default {
    name: 'MyInput',

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
    computed: {
        listeners: function() {
            return {
                ...this.$listeners,
                input: event => this.$emit('input', event.target.value)
            }
        }
    },

    methods:{
        handleInput: function() {

            clearTimeout(this.isTyping);

            this.isTyping = setTimeout(()=>{
                this.$emit('doneTyping');
            }, 800);

            this.$emit('input', this.component_value);
        }
    }

}
</script>

<style>

</style>
