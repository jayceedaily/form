<template>
<div>
    <div v-if="isLoading">
        <div class="columns  is-vcentered" style="height:85vh">
            <div class="column">
                <div class="has-text-centered">
                    <my-loader color="has-background-primary"/>
                </div>
            </div>
        </div>
    </div>
    <div v-else>
        <div class="container">
            <div class="columns">
                <div class="column is-8 is-offset-2">
                    <div class="card">
                        <div class="card-content">
                            <h1 class="is-size-3 mb-10">{{form.name}}</h1>
                            <p class="">{{form.description}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="form.questions.length > 0">
                <transition-group>
                    <div class="columns" v-for="(question, index) in form.questions" :key="question.id">
                        <div class="column is-8 is-offset-2">
                            <question-item :question="question" :order="index+1" @addQuestion="handleAddQuestion" @deleteQuestion="showDeleteQuestionModal=true" :id="'question'+question.id"/>
                        </div>
                    </div>
                </transition-group>
            </div>
            <div v-else>
                <div class="columns">
                    <div class="column is-8 is-offset-2">
                        <question-item @addQuestion="handleAddQuestion" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <delete-question-modal v-if="showDeleteQuestionModal" @close="showDeleteQuestionModal=false"/>

</div>
</template>

<script>
import {mapActions,mapGetters} from 'vuex';
import QuestionItem from './QuestionItem';
import DeleteQuestionModal from './DeleteQuestionModal';

export default {
    name: 'ShowForm',
    components: {
        QuestionItem,
        DeleteQuestionModal,
    },
    data: function() {
        return {
            isLoading: true,
            showDeleteQuestionModal: false
        }
    },

    computed: {
        ...mapGetters({form:'form/selected'}),
    },

    created: function() {
        this.showForm(this.$route.params.id).then((r) => {
            this.isLoading = false;
        })
    },

    methods: {
        ...mapActions({showForm: 'form/show', addQuestionForm:'form/addQuestion'}),

        handleAddQuestion: function(value) {

            console.log(value)

            var VueScrollTo = require('vue-scrollto');

            Array.prototype.insert = function ( index, item ) {
                this.splice( index, 0, item );
            };

            this.addQuestionForm(Number.isInteger(value) ? {
                content: '',
                description: '',
                is_required: 1,
                order_number: value,
                } : value).then((response) => {
                if(response.status == 201) {
                    this.form.questions.insert(value-1 ,response.data);


                    setTimeout(()=>{
                        VueScrollTo.scrollTo('#question'+response.data.id,300, {offset:-30})
                    }, 100)

                }


            });
        },

        handleDeleteQuestion: function() {

        }
    }
}
</script>

<style>

</style>
