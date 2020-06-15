<template>
<nav class="navbar is-primary" role="navigation" aria-label="main navigation">

  <div id="navbarBasicExample" class="navbar-menu container">


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
            <a class="navbar-item">Logout</a>
            </div>
        </div>
    </div>
  </div>
</nav>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
    name: 'TheNav',
    computed:{
        ...mapGetters({user:'auth/user'})
    }
}
</script>

<style>

</style>
