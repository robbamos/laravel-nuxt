<template>
  <v-app>
    <navbar />
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
    Navbar,

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
      return this.$store
        .dispatch("auth/logout")
        .then(res => {
          console.log(res);
          this.$router.push("/");
        })
        .catch(err => {
          console.log(err);
        });
    }
  },
  computed: {
    isLoggedIn() {
      return this.$store.getters["auth/isLoggedIn"];
    },
    menu() {
      return this.$store.getters["auth/topNavMenu"];
    }
  }
};
</script>

