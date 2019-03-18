<template>
  <v-app>
    <navbar/>
    <v-content>
      <v-container>
        <nuxt/>
      </v-container>
    </v-content>

    <v-footer :fixed="fixed" app>
      <span>&copy; {{ new Date().getFullYear() }}</span>
    </v-footer>
  </v-app>
</template>

<script>
import Navbar from "@/components/Navbar.vue";

export default {
  components: {
    Navbar
  },
  data() {
    return {
      clipped: false,
      drawer: false,
      fixed: false,
      // menu: [
      //   { icon: "home", title: "Home", to: "/" },
      //   { icon: "info", title: "Register", to: "/register" },
      //   { icon: "info", title: "Login", to: "/login" }
      // ],
      miniVariant: false,
      right: true,
      rightDrawer: false,
      title: "Vuetify.js"
    };
  },
  methods: {
    logout() {
      this.$auth.logout();
    }
  },
  computed: {
    menu() {
      return this.$store.getters["auth/topNavMenu"];
    }
  }
};
</script>

