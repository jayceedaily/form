<template>
    <my-modal :open="true" @close="handleClose">
        <div class="modal-content">
            <div class="card">
                <div class="card-content">
                    <div class="columns">
                        <div class="column">
                            <p class="is-size-5">Delete {{(question.content ? question.content : '') + ' '}}question?</p>
                        </div>
                    </div>
                    <div class="columns">
                        <div class="column">
                            <div class="is-pulled-right">
                                <button class="button is-danger" @click="handleDelete">Delete</button>
                                <button class="button" @click="handleClose">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </my-modal>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
export default {
    name: 'DeleteQuestionModal',


    computed: {
        ...mapGetters({question:'question/selected'}),
    },

    methods: {
        ...mapActions({deleteQuestion:'question/delete', removeQuestionForm: 'form/removeQuestion'}),

        handleClose: function() {
            this.$emit('close');
        },

        handleDelete: function() {

            let _temp_question = Object.assign({}, this.question);

            this.deleteQuestion().then(response => {
                if(response.status == 200) {

                    this.removeQuestionForm(_temp_question);
                }

                this.handleClose();

            });
        }
    }

}
</script>

<style>

</style>
