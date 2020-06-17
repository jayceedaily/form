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

            <transition-group>
                <div class="columns" v-for="question in form.questions" :key="question.id">
                    <div class="column is-8 is-offset-2">
                        <question-item :question="question"/>
                    </div>
                </div>
            </transition-group>

        </div>

    </div>
</div>
</template>

<script>
import {mapActions,mapGetters} from 'vuex';
import QuestionItem from './QuestionItem';

export default {
    name: 'ShowForm',
    components: {
        QuestionItem,
    },
    data: function() {
        return {
            isLoading: true,
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
        ...mapActions({showForm: 'form/show'}),
    }
}
</script>

<style>

</style>
