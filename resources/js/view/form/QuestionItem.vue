<template>
    <div class="card" >
        <div class="card-content">
            <div class="columns">
                <div class="column">
                    <my-dropdown class="is-pulled-right">
                        <template v-slot:trigger>
                            <span style="cursor:pointer"><i class="material-icons is-pulled-right">more_horiz</i></span>
                        </template>
                        <template v-slot:menu>
                            <router-link to="" class="dropdown-item has-text-danger">Delete</router-link>
                        </template>
                    </my-dropdown>
                </div>
            </div>

            <div class="columns">
                <div class="column is-8">
                    <my-input v-model="question.content"/>
                </div>
                <div class="column is-4">
                    <div class="select">
                        <select name="" id="">
                            <option value="">Multiple Choice</option>
                            <option value="">Text</option>
                        </select>
                    </div>
                </div>
            </div>

            <hr class="pa-0">

            <div class="columns" v-for="questionOption in question.options" :key="questionOption.id">
                <div class="column">
                    <option-item :questionOption="questionOption" />
                </div>
            </div>
            <a @click="addOption" class="">Add another option</a>
        </div>
        <hr class="ma-0">
        <div class="card-content">
            <div class="columns">
                <div class="column">
                    <!-- <button class="button mr-10"><i class="material-icons">keyboard_arrow_up</i></button>
                    <button class="button"><i class="material-icons">keyboard_arrow_down</i></button> -->
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
    props: ['question'],
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
                    
                });
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
                is_correct: null,
                is_new: true,
            });
        },

        saveChanges: function() {

            this.loadLeftTextNav('Saving...');

            this.selectQuestion(this.question);

            this.updateQuestion(this.question).then((response) => {
                this.loadLeftTextNav('Saved');
            })
        },

        addOption: function() {

        },
    }
}
</script>

<style>

</style>
