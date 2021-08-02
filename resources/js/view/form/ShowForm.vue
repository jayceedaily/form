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
                <div class="column  is-8 is-offset-2">
                    <div class="tabs is-centered">
                        <ul>
                            <router-link tag="li" :to="'/form/'+form.uuid"><a href="">Questions</a></router-link>
                            <router-link tag="li" :to="'/form/'+form.uuid + '/response'"><a href=""><span class="mr-10">Responses</span><span class="tag is-rounded is-primary">{{form.sheets_count}}</span></a></router-link>
                        </ul>
                    </div>
                </div>
            </div>
            <div v-if="!showFormResponse">
                <div class="columns">
                    <div class="column is-8 is-offset-2">
                        <div class="card">
                            <div class="card-content">
                                <div class="columns">
                                    <div class="column">
                                        <my-dropdown class="is-pulled-right" style="width:20px!important;" compact>
                                            <template v-slot:trigger>
                                                <span style="cursor:pointer"><i class="material-icons is-pulled-right">more_horiz</i></span>
                                            </template>
                                            <template v-slot:menu style="min-width:auto!important;">
                                                <a @click="handleAddQuestion(1)" class="dropdown-item " style="padding-right:1rem"><i class="material-icons">add_circle_outline</i></a>
                                                <!-- <a @click="deleteQuestion"  class="dropdown-item " style="padding-right:1rem"><i class="material-icons">remove_circle_outline</i></a> -->
                                                <router-link to="" class="dropdown-item " style="padding-right:1rem"><i class="material-icons">text_fields</i></router-link>
                                            </template>
                                        </my-dropdown>
                                    </div>
                                </div>
                                <div class="columns">
                                    <div class="column">
                                        <input type="text" class="input" v-model="form.name" @input="handleChanges"/>
                                    </div>
                                </div>
                                <div class="columns">
                                    <div class="column">
                                        <my-editor v-model="form.description" @input="handleChanges"/>
                                    </div>
                                </div>
                                <!-- <h1 class="is-size-3 mb-10">{{form.name}}</h1> -->
                                <!-- <p class="" style="white-space: pre-wrap;">{{form.description}}</p> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div v-if="form.questions && form.questions.length > 0">
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
                <delete-question-modal v-if="showDeleteQuestionModal" @close="showDeleteQuestionModal=false"/>
            </div>
            <div v-else>
                <show-form-response />
            </div>

        </div>
    </div>
</div>
</template>

<script>
import {mapActions,mapGetters} from 'vuex';
import QuestionItem from './QuestionItem';
import DeleteQuestionModal from './DeleteQuestionModal';
import ShowFormResponse from './ShowFormResponse';


export default {
    name: 'ShowForm',
    components: {
        QuestionItem,
        DeleteQuestionModal,
        ShowFormResponse,

    },

    data: function() {
        return {
            isLoading: true,
            showDeleteQuestionModal: false,
            isTyping: null,
            editor: null
        }
    },

    computed: {
        ...mapGetters({form:'form/selected'}),

        showFormResponse: function() {
            return this.$route.name == 'ShowFormResponse';
        }
    },

    created: function() {
        this.showForm(this.$route.params.id).then((r) => {
            this.isLoading = false;
        })
    },

    methods: {
        ...mapActions({showForm: 'form/show',
                        addQuestionForm:'form/addQuestion',
                        updateForm: 'form/update'
        }),

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

                    setTimeout(()=> {
                        VueScrollTo.scrollTo('#question'+response.data.id,1000, {offset:-30})
                    }, 100)
                }
            });
        },

        handleChanges: function() {
            clearTimeout(this.isTyping)

            this.isTyping = setTimeout(()=>{
                this.updateForm(this.form);
            }, 1000);

        }
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
