<template>
    <div class="dropdown" :class="showMenu ? 'is-active' : ''" >
        <div @click="showMenu =! showMenu" class="dropdown-trigger" @blur="handleBlur">
            <slot name="trigger"/>
        </div>
        <div class="dropdown-menu" role="menu"  :style="compact ? 'min-width:20px!important;' : ''">
            <div class="dropdown-content"  @click="showMenu = false">
                <slot name="menu"/>
            </div>
        </div>
    </div>
</template>


<script>

export default {
    name: 'MyDropdown',
    props: {
        compact: {
            type: Boolean,
            required: false,
            default:false
        }
    },
    data: function() {
        return {
            showMenu: false,
        }
    },
    methods:{
        handleBlur(){
            console.log('red');
        }
    }

}
</script>

<style>

</style>
