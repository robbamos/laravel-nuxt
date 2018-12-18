<template>
  <v-app>
    <dashboard-drawer/>
    <navbar/>

    <v-content>
      <v-container>
        <nuxt/>
      </v-container>
    </v-content>

    <v-footer :fixed="false" app>
      <span>&copy; {{ new Date().getFullYear() }}</span>
    </v-footer>
  </v-app>
</template>

<script>
import Navbar from "@/components/Navbar.vue";
import DashboardDrawer from "@/components/Dashboard/Drawer.vue";
export default {
  components: {
    Navbar,
    DashboardDrawer
  }
};
</script>

