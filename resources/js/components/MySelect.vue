<template>
    <div class="field">
        <p><label for="">{{label}}</label></p>
        <div class="control">
            <div class="select is-fullwidth" :class="isLoading ? 'is-loading' : ''">
                <select name="" id="" v-on="listeners">
                    <option v-for="option in options" :key="option.id" :option="option" :value="option.id">{{option.name}}</option>
                </select>
            </div>
        </div>
        <span class="has-text-danger">{{error}}</span>
    </div>
</template>

<script>
export default {
    name: 'MySelect',
    props: {
        isLoading: {
            required: false,
            type: Boolean,
            default: false
        },
        options: {
            required: true,
            type: Array
        },
        value: {
            required: false,
            type: String
        },
        label: {
            required: false,
            type: String,
            default: '',
        },
        error: {
            required: false,
            type: String,
            default: '',
        },
        required: {
            required: false,
            type: Boolean,
            default: false,
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

}
</script>

<style>

</style>
