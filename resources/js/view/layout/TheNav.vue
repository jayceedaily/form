<template>
<nav class="navbar is-primary" role="navigation" aria-label="main navigation">

    <a role="button" class="navbar-burger"   @click="showHamburger = !showHamburger" :class="showHamburger ? 'is-active' : ''" aria-label="menu" aria-expanded="false">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
    </a>

  <div id="navbarBasicExample" class="navbar-menu"  :class="showHamburger ? 'is-active' : ''" >

    <div class="navbar-start">
        <a class="navbar-item is-loading">
            {{leftText}}
        </a>
    </div>
    <div class="navbar-end">
        <router-link class="navbar-item" to="/">Dashboard</router-link>
        <router-link class="navbar-item" to="/form">Form</router-link>
        <div class="navbar-item has-dropdown is-hoverable">
            <a class="navbar-link">
            {{user.name}}
            </a>

            <div class="navbar-dropdown">
            <a class="navbar-item">
                About
            </a>
            <a class="navbar-item">
                Jobs
            </a>
            <a class="navbar-item">
                Contact
            </a>
            <hr class="navbar-divider">
            <a class="navbar-item" @click="logout">Logout</a>
            </div>
        </div>
    </div>
  </div>
</nav>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'
export default {
    name: 'TheNav',
    data(){
        return {
            showHamburger: false
        }
    },
    computed:{
        ...mapGetters({user:'auth/user', leftText: 'nav/leftText'})
    },
    methods: {
        ...mapActions({logout: 'auth/logout'}),
    }
}
</script>

<style>

</style>
