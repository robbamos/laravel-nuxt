<template>
  <v-layout column justify-center align-center>
    <v-flex xs12 sm8 md6>
      <v-layout align-center justify-center class="mb-5">
        <img src="/laravel.png" alt="Laravel" class="mx-auto">
        <v-icon>add</v-icon>
        <img src="/nuxt.png" alt="Nuxt.js" class="mx-auto">
        <v-icon>add</v-icon>

        <img src="/v.png" alt="Vuetify.js" class="mx-auto">
      </v-layout>
      <v-card>
        <v-card-title class="headline">Welcome to the Laravel + Nuxt.js template</v-card-title>
        <v-card-text>
          <p>
            This repo is designed to be a quick start template for a Nuxt.js based frontend application, powered by
            a Laravel backend.
          </p>
          <p>
            For instructions on how to quickly get started with this template, check out the
            <a
              href="https://github.com/robbamos/laravel-nuxt"
              target="__blank"
            >repo</a>.
          </p>
          <p>
            JWT Authentication boilerplate is also included via
            <a
              href="https://github.com/tymondesigns/jwt-auth"
              target="__blank"
            >Tymon</a>, inconjunction with the
            <a href="https://auth.nuxtjs.org/" target="__blank">Nuxt.js Auth Module</a>.
          </p>
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
          <p>Thank you for using this template, I will be refining and adding more features in the future.</p>
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
      </v-card>
    </v-flex>
  </v-layout>
</template>

<script>
export default {
  middleware: ["auth"],
  options: {
    auth: false
  }
};
</script>
