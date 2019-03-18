<template>
  <div>
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
        <v-btn v-if="$auth.loggedIn" @click.prevent="$auth.logout()" flat>Logout</v-btn>
        <v-btn v-else to="/login" flat>Login</v-btn>
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
            <v-icon @click="drawer = false">chevron_right</v-icon>
          </v-list-tile-action>
        </v-list-tile>

        <v-list-tile avatar tag="div">
          <v-list-tile-avatar>
            <v-avatar>
              <v-icon>user</v-icon>
            </v-avatar>
          </v-list-tile-avatar>

          <v-list-tile-content v-if="$auth.loggedIn">
            <v-list-tile-title>{{ $store.state.auth.user.name }}</v-list-tile-title>
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
        <v-list-tile v-if="$auth.loggedIn" @click.prevent="$auth.logout()">
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
      title: "Nuxt + Laravel"
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

