<template>
    <div>
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
                <i class="material-icons is-size-6" style="cursor:pointer" @click="handleDeleteOption">close</i>
            </div>
        </div>
        <div class="columns">
            <div class="column" v-if="questionOption.info != null && questionOption.info != ''">
                <label for=""></label>
                <textarea name="" id="" cols="30" rows="1" class="textarea" v-model="questionOption.info"></textarea>
            </div>
            <div v-else class="column" >
                <a style="padding-left:35px" @click="questionOption.info = ' '">Add info</a>
            </div>
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
        ...mapActions({updateOption:'option/update',
        selectOption :'option/select',
        loadLeftTextNav:'nav/loadLeftText',
        deleteOption: 'option/delete'
        }),

        saveChanges: function() {

            if(this.questionOption.id  == null) {

                this.$emit('createOption', this.questionOption);

            } else {

                this.loadLeftTextNav('Saving...');

                this.selectOption(this.questionOption);

                this.updateOption(this.questionOption).then((response)=>{
                    if(response.status == 200) {
                        this.loadLeftTextNav('Saved');
                    } else {
                        this.loadLeftTextNav('Something went wrong');
                    }
                });

            }
        },

        handleDeleteOption: function() {

            this.selectOption(this.questionOption);

            this.deleteOption().then(reponse => {
                this.$emit('delete', this.questionOption)
            });
        }
    }
}
</script>

<style>

</style>
