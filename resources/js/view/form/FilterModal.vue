<template>
    <my-modal open @close="$emit('close')">
        <div class="card pa-100">
            <p>create filter fields</p>
            <my-autocomplete></my-autocomplete>
        </div>
    </my-modal>
</template>

<script>
export default {
    name: 'FilterModal'
}
</script>

<style>

</style>
