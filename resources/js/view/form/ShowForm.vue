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
                            <p class="" style="white-space: pre-wrap;">{{form.description}}</p>
                            <textarea name="" id="" cols="30" rows="10" class="textarea" v-model="form.description"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="form.questions.length > 0">
                <transition-group name="list-complete">
                    <div class="columns  list-complete-item" v-for="(question, index) in form.questions" :key="question.id">
                        <div class="column is-8 is-offset-2" >
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
                        VueScrollTo.scrollTo('#question'+response.data.id,1000, {offset:-30})
                    }, 100)

                }
            });
        },
    }
}
</script>

<style>
.list-complete-item {
  transition: all 1s;
  display: inline-block;
  margin-right: 10px;
}
.list-complete-enter, .list-complete-leave-to
/* .list-complete-leave-active below version 2.1.8 */ {
  opacity: 0;
  transform: translateY(30px);
}
.list-complete-leave-active {
    width: 100%;
  position: absolute;
}
</style>
