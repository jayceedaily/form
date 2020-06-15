<template>
<div class="lds-ellipsis"><div :class="color"></div><div :class="color"></div><div :class="color"></div><div :class="color"></div></div>
</template>

<script>
export default {
    name:'MyLoader',
    props: ['color']
}
</script>

<style>

</style>
