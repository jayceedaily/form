<template>
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
    </div>
</template>

<script>
export default {
    name: 'AddEditForm',
    props: {
        form: {
            required: false,
            type: Object,
            default: function() {
              return {
                    id: null,
                    name: null,
                    description: null,
                    has_random_questions: false,
                    questions: [],
                }
            }
        }
    },

    methods: {
        saveChanges: function() {
            if(this.form.id == null) {
                //create
            } else {
                //update
            }
        }
    }
}
</script>

<style>

</style>
