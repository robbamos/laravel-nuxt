<template>
  <v-navigation-drawer v-model="drawer" fixed clipped app right class="hidden-md-and-up">
    <v-list class="pa-1">
      <v-list-tile>
        <v-list-tile-action>
          <v-icon @click="drawer = !drawer">chevron_right</v-icon>
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
    <v-list>
      <v-list-tile v-if="!$auth.loggedIn" router to="/register" exact>
        <v-list-tile-title>Register</v-list-tile-title>
      </v-list-tile>

      <v-list-tile v-if="!$auth.loggedIn" router to="/login" exact>
        <v-list-tile-title>Login</v-list-tile-title>
      </v-list-tile>

      <v-list-tile v-if="$auth.loggedIn" router @click.prevent="$auth.logout()">
        <v-list-tile-title>Logout</v-list-tile-title>
      </v-list-tile>
    </v-list>

    <v-list class="pt-0" dense>

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
</template>

<script>
export default {
  props: {
    value: {
      type: Boolean,
      default: false
    },
    menu: {
      type: Array,
      default: () => {
        return [];
      }
    }
  },

  computed: {
    drawer: {
      get: function() {
        return this.value;
      },
      set: function(val) {
        this.$emit("input", val);
      }
    }
  }
};
</script>

