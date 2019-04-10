<template>
  <v-app>
    <drawer v-model="drawer" :menu="menu"/>
    <navbar @toggle="drawer = !drawer" :menu="menu"/>
    <v-content>
      <v-container fluid fill-height>
        <nuxt/>
      </v-container>
    </v-content>
  </v-app>
</template>


<script>
import Navbar from "@/components/Navbar.vue";
import Drawer from "@/components/Drawer.vue";

export default {
  components: {
    Navbar,
    Drawer
  },
  data() {
    return {
      drawer: false
    };
  },

  computed: {
    menu() {
      if (this.$auth.loggedIn) {
        return [
          {
            icon: "apps",
            title: "Overview",
            to: "/dashboard"
          },
          {
            icon: "account_box",
            title: "Inspire",
            to: "/dashboard/inspire"
          }
        ];
      }
    }
  }
};
</script>

