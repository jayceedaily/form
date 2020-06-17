<template>
        <div class="columns">
            <div class="column is-11">



                <div class="field is-horizontal">

                    <div style="display: flex; align-items: center; justify-content: center;">

                        <i class="material-icons has-text-grey-lighter">crop_din</i>
                    </div>

                    <div class="field-body">
                        <div class="field">
                        <p class="control"  @mouseenter="showEdit=true"  @mouseleave="showEdit=false" :style="!showEdit  && !isEditing? 'margin-left:11px' : ''">
                            <input class="input" type="text" v-model="questionOption.content" :class="!showEdit && !isEditing ? 'is-static' : ''"  @click="isEditing=true" @blur="isEditing=false">
                        </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column is-1" style="display: flex; align-items: center; justify-content: center;">
                <i class="material-icons is-size-6">close</i>
            </div>
        </div>

</template>

<script>
import { mapActions } from 'vuex';
export default {
    name: 'OptionItem',
    props: {
        questionOption: {
            required: true,
            type: Object,
        }
    },
    data: function() {
        return {
            showEdit: false,

            isEditing: false,

            isTyping: null,
        }
    },

    watch: {
        questionOption: {
            deep: true,

            handler: function() {

                clearTimeout(this.isTyping);

                this.isTyping = setTimeout(() => {
                    this.saveChanges();
                }, 1000);

            }
        }
    },

    methods: {
        ...mapActions({updateOption:'option/update', selectOption :'option/select'}),

        saveChanges: function() {

            if(this.questionOption.is_new === true) {

                console.log('create new')

            } else {
                console.log('update existing')

                this.selectOption(this.questionOption);

                this.updateOption(this.questionOption);

            }
        }

    }

}
</script>

<style>

</style>
