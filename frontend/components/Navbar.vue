<template>
  <v-toolbar dense clipped-left app>
    <router-link to="/">
      <v-img
        src="/v.png"
        alt="Vuetify.js"
        height="40"
        width="40"
        max-height="40"
        max-width="40"
        class="d-inline-block"
      />
      <v-toolbar-title color="primary" class="d-inline-block">Laravel + Nuxt</v-toolbar-title>
    </router-link>
    <v-spacer></v-spacer>
    <v-toolbar-items class="hidden-sm-and-down">
      <v-btn v-for="(item, index) in menu" :key="index" :to="item.to" flat exact>{{ item.title }}</v-btn>
      <v-btn v-if="!$auth.loggedIn" to="/register" flat>Register</v-btn>
      <v-btn v-if="$auth.loggedIn" @click.prevent="$auth.logout()" flat>Logout</v-btn>
      <v-btn v-else to="/login" flat>Login</v-btn>
    </v-toolbar-items>

    <v-toolbar-side-icon @click="$emit('toggle')" class="hidden-md-and-up"></v-toolbar-side-icon>
  </v-toolbar>
</template>

<script>
export default {
  props: {
    menu: {
      type: Array,
      default: () => {
        return [];
      }
    }
  }
};
</script>

