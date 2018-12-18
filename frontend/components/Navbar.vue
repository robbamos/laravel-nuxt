<template>
  <div>
    <v-toolbar dense clipped-left app>
      <router-link to="/" >
        <v-img src="/v.png" alt="Vuetify.js" height="40" width="40" max-height="40" max-width="40" class="d-inline-block"/>
        <v-toolbar-title color="primary" class="d-inline-block">Nuxt + Laravel</v-toolbar-title>
      </router-link>
      <v-spacer></v-spacer>
      <v-toolbar-items class="hidden-sm-and-down">
        <v-btn v-for="(item, index) in menu" :key="index" :to="item.to" flat>{{ item.title }}</v-btn>
        <v-btn v-if="isLoggedIn" @click.prevent="logout" flat>Logout</v-btn>
      </v-toolbar-items>

      <v-toolbar-side-icon @click.stop="drawer = !drawer" class="hidden-md-and-up"></v-toolbar-side-icon>
    </v-toolbar>
    <v-navigation-drawer
      v-model="drawer"
      right
      absolute
      dark
      app
      temporary
      disable-resize-watcher
      disable-route-watcher
    >
      <v-list class="pa-1">
        <v-list-tile>
          <v-list-tile-action>
            <v-icon>chevron_right</v-icon>
          </v-list-tile-action>
        </v-list-tile>

        <v-list-tile avatar tag="div">
          <v-list-tile-avatar>
            <img src="https://randomuser.me/api/portraits/men/85.jpg">
          </v-list-tile-avatar>

          <v-list-tile-content>
            <v-list-tile-title>John Leider</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
      </v-list>

      <v-list class="pt-0" dense>
        <v-divider light></v-divider>

        <v-list-tile router :to="item.to" v-for="(item, i) in menu" :key="i" exact>
          <v-list-tile-title v-text="item.title"></v-list-tile-title>
          <v-list-tile-action>
            <v-icon v-html="item.icon"></v-icon>
          </v-list-tile-action>
        </v-list-tile>
        <v-list-tile  v-if="isLoggedIn" @click.prevent="logout" >
          <v-list-tile-title>Logout</v-list-tile-title>
         
        </v-list-tile>
       
      </v-list>
    </v-navigation-drawer>
  </div>
</template>

<script>
export default {
  data() {
    return {
      clipped: false,
      drawer: false,
      fixed: false,
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

