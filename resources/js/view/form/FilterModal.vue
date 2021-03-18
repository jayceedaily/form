<template>
    <my-modal open @close="$emit('close')">
        <div class="card pa-10">
            <p>create filter fields</p>
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
