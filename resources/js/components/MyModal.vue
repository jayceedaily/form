<template>
    <div class="modal" :class="open ? 'is-active' : ''">
    <div class="modal-background"></div>
    <div class="modal-content">
        <slot></slot>
    </div>
    <button class="modal-close is-large" aria-label="close" @click="handleCloseModal"></button>
    </div>
</template>

<script>
export default {
    name:'MyModal',
    props: {
        open: {
            type: Boolean,
            required: false,
            default: false
        }
    },
    methods: {
        handleCloseModal: function() {
            this.$emit('close');
        }
    }
}
</script>

<style>

</style>
