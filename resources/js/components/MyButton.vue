<template>
<button class="button" :class="isLoading ? 'is-loading' : ''" ><slot></slot></button>
</template>

<script>
export default {
    name: 'MyButton',
    props: {
        isLoading: {
            type: Boolean,
            required: false,
            default: false
        }
    }


}
</script>

<style>

</style>
