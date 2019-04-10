<template>
  <v-layout column justify-center align-center>
    <v-flex xs12 sm8 md6>
      <div class="text-xs-center">
        <img src="/v.png" alt="Vuetify.js" class="mb-5">
      </div>
      <v-card>
        <v-card-title class="headline">Welcome {{ user }} to the Nuxt.js + Laravel template</v-card-title>
        <v-card-text>
          <p>Welcome to the Laravel + Nuxt quick start template! This template aims to provide an easy to use boilerplate for a nuxt powered frontend app that consumes a laravel backend api.</p>
          <p>Currently this template is configured with the excellent Vuetify framework.</p>
          <p>
            For more information on Vuetify, check out the
            <a
              href="https://vuetifyjs.com"
              target="_blank"
            >documentation</a>.
          </p>

          <p>
            Find a bug? Report it on the github
            <a
              href="https://github.com/robbamos/laravel-nuxt/issues"
              target="_blank"
              title="contribute"
            >issue board</a>.
          </p>
          <div class="text-xs-right">
            <em>
              <small>&mdash; Rob Amos</small>
            </em>
          </div>
          <hr class="my-3">
          <a href="https://nuxtjs.org/" target="_blank">Nuxt Documentation</a>
          <br>
          <a href="https://github.com/nuxt/nuxt.js" target="_blank">Nuxt GitHub</a>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="primary" flat nuxt to="/inspire">Continue</v-btn>
        </v-card-actions>
      </v-card>
    </v-flex>
  </v-layout>
</template>


<script>
import Drawer from "@/components/Dashboard/Drawer.vue";
export default {
  layout: "dashboard",
  middleware: ["auth"],
  components: {
    Drawer
  },
  computed: {
    user() {
      return this.$store.state.auth.user.name;
    }
  }
};
</script>
