<template>
    <div class="container">
        <div class="card">
            <div class="card-content">
                <form action="" @submit.prevent="login">
                    <div class="columns">
                        <div class="column">
                            <my-input v-model="form.email" label="Email" type="email" :errors="errors.email" required/>
                        </div>
                    </div>
                    <div class="columns">
                        <div class="column">
                            <my-input v-model="form.password" label="Password" type="password" :errors="errors.password" required/>
                        </div>
                    </div>
                    <div class="columns">
                        <div class="column">
                            <my-button class="is-primary" :isLoading="isLoading">Login</my-button>
                        </div>
                    </div>

                </form>
            </div>
        </div>

    </div>
</template>

<script>
import {mapActions} from 'vuex';

export default {
    name: 'LoginForm',
    data: function () {
        return {

            isLoading: false,

            form: {
                email: null,
                password: null,
            },
            errors: {
                email: null,
                password: null,
            },
        }
    },

    methods: {
        ...mapActions({loginUser: 'auth/login'}),

        login : function() {

            this.isLoading = true

            this.loginUser(this.form).then((response) => {
                if(response.status == 200) {

                } else if(response.status == 422) {

                    Object.keys(response.data.errors).forEach((error) => {
                        this.errors[error] = response.data.errors[error].join(', ');
                    })

                } else {

                }

                this.isLoading = false

            })
        },
    }
}
</script>

<style>

</style>
