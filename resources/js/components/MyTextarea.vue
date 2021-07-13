<template>
    <div class="field">
        <p><label for="">{{label}}</label></p>
        <textarea class="textarea" :placeholder="placeholder" v-on="listeners" :value="value"></textarea>
    </div>
</template>

<script>
export default {
    name: 'MyTextarea',
    props: {
        placeholder: {
            required:false,
            type: String,
            default: ''
        },
        label: {
            required: false,
            type: String,
            default: '',
        },
        value: {
            required: false,
            type: String,
            default: null
        },
        error: {
            required: false,
            type: String,
            default: null,
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
    methods: {

    }
}
</script>

<style>

</style>
