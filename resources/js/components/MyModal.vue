<template>

        <div class="modal" :class="open ? 'is-active' : ''">
        <div class="modal-background"></div>
            <transition name="pop">
                <div class="modal-content">
                    <slot></slot>
                </div>
            </transition>
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
.fade-enter-active,
.fade-leave-active {
  transition: opacity .4s linear;
}

.fade-enter,
.fade-leave-to {
  opacity: 0;
}

.pop-enter-active,
.pop-leave-active {
  transition: transform 0.4s cubic-bezier(0.5, 0, 0.5, 1), opacity 0.4s linear;
}

.pop-enter,
.pop-leave-to {
  opacity: 0;
  transform: scale(0.3) translateY(-50%);
}
</style>
