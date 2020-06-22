<template>
    <div class="card" >
        <div class="card-content">
            <div class="columns">
                <div class="column">
                    <span class="tag is-info">{{order === false ? 'Add question' : 'Question '+order}}</span>
                    <my-dropdown class="is-pulled-right" style="width:20px!important;" compact>
                        <template v-slot:trigger>
                            <span style="cursor:pointer"><i class="material-icons is-pulled-right">more_horiz</i></span>
                        </template>
                        <template v-slot:menu style="min-width:auto!important;">
                            <a @click="addQuestion" class="dropdown-item " style="padding-right:1rem"><i class="material-icons">add_circle_outline</i></a>
                            <a @click="deleteQuestion"  class="dropdown-item " style="padding-right:1rem"><i class="material-icons">remove_circle_outline</i></a>
                            <!-- <router-link to="" class="dropdown-item " style="padding-right:1rem"><i class="material-icons">text_fields</i></router-link> -->
                        </template>
                    </my-dropdown>
                </div>
            </div>

            <div class="columns">
                <div class="column is-8">
                    <my-input v-model="question.content"/>
                </div>
                <div class="column is-4">
                    <div class="select is-fullwidth">
                        <select name="" id="">
                            <option value="multiple">Multiple choice</option>
                            <option value="input">Input answer</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="columns">
                <div class="column">
                    <textarea class="textarea" name="" id="" cols="30" rows="1" v-model="question.description"></textarea>
                </div>
            </div>

            <hr class="pa-0">

            <div class="columns" v-for="questionOption in question.options" :key="questionOption.id">
                <div class="column">
                    <option-item :questionOption="questionOption" @createOption="handleCreateOption" @delete="handleDeleteOption"/>
                </div>
            </div>

            <a @click="addOption" class="">Add another option</a>
        </div>
        <hr class="ma-0">
        <div class="card-content">
            <div class="columns">
                <div class="column">
                    <button class="button mr-10"><i class="material-icons">keyboard_arrow_up</i></button>
                    <button class="button"><i class="material-icons">keyboard_arrow_down</i></button>
                    <div class="is-pulled-right">
                        <label class="checkbox">
                            <input type="checkbox" v-model="question.is_required">
                            Required
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import OptionItem from './OptionItem'
import { mapActions } from 'vuex';

export default {
    name: 'QuestionItem',
    props: ['question','order'],

    props: {
        question: {
            required: false,
            type: Object,
            default: function(){
                return {
                    content: '',
                    description: '',
                    is_required: 1
                };
            }
        },

        order: {
            required: false,
            type: Number,
            default: 0
        }
    },

    components:{
        OptionItem
    },
    data: function() {
        return {
            isTyping: false,
        }
    },
    watch: {
        question: {
            handler: function() {

                clearTimeout(this.isTyping);

                this.isTyping = setTimeout(() => {
                    this.saveChanges()
                }, 800);
            },

            deep: true
        }
    },

    methods: {

        ...mapActions({ updateQuestion:'question/update',
                        selectQuestion:'question/select',
                        addOptionQuestion: 'question/addOption',
                        loadLeftTextNav:'nav/loadLeftText'
                        }),

        addOption: function() {

            this.question.options.push({
                content: null,
                info: null,
                is_correct: false,
                id: null,
            });
        },

        addQuestion: function() {
            this.$emit('addQuestion', this.order + 1);
        },

        deleteQuestion: function() {

            this.selectQuestion(this.question);

            this.$emit('deleteQuestion');

        },

        saveChanges: function() {


            if(this.question.id == null){

                this.$emit('addQuestion', this.question);

            } else {
                this.loadLeftTextNav('Saving...');

                this.selectQuestion(this.question);

                this.updateQuestion(this.question).then((response) => {

                    this.loadLeftTextNav('Saved');

                })
            }

        },

        handleCreateOption: async function(data) {

            this.selectQuestion(this.question);

            await this.addOptionQuestion(data).then(response =>{
                data.id = response.data.id;
                console.log(data)
            });

        },

        handleDeleteOption: function(item){
            let order = this.question.options.findorder( list_item => list_item.id == item.id );

           if(order !== false) {

                this.question.options.splice(order, 1);
           }
        }
    }
}
</script>

<style>

</style>

