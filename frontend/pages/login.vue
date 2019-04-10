<template>
  <v-layout align-center justify-center>
    <v-flex xs12 sm8 md6>
      <v-card class="elevation-12">
        <v-toolbar dark color="primary">
          <v-toolbar-title>Login</v-toolbar-title>
        </v-toolbar>
        <v-card-text>
          <v-alert v-model="failed" type="error" :dismissible="true">{{ error }}</v-alert>
          <v-form ref="form" lazy-validation @submit.prevent="login" @keyup.enter.native="login">
            <v-text-field v-model="user.email" :rules="emailRules" label="E-mail" required></v-text-field>
            <v-text-field
              v-model="user.password"
              :append-icon="passwordVisible ? 'visibility_off' : 'visibility'"
              :rules="passwordRules"
              :type="passwordVisible ? 'text' : 'password'"
              name="input-10-1"
              label="Password"
              @click:append="passwordVisible = !passwordVisible"
            ></v-text-field>

            <!-- <v-checkbox v-model="remember" label="Remember Me" required></v-checkbox> -->
          </v-form>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn type="submit" color="primary" @click.prevent="login">Login</v-btn>
        </v-card-actions>
      </v-card>
    </v-flex>
  </v-layout>
</template>

<script>
export default {
  middleware: ["auth"],
  layout: "auth",
  head() {
    return { title: "Login" };
  },
  data() {
    return {
      passwordVisible: false,
      failed: false,
      error: null,
      user: {
        email: "",
        password: ""
      },
      remember: false,
      emailRules: [
        v => !!v || "E-mail is required",
        v => /.+@.+/.test(v) || "E-mail must be valid"
      ],
      passwordRules: [v => !!v || "Password is required"]
    };
  },
  methods: {
    login() {
      this.$auth
        .login({
          data: this.user
        })
        .then(resp => {
          console.log(resp);
        })
        .catch(err => {
          console.log(err);
        });
    },

    clear() {
      this.$refs.form.reset();
    }
  },
  computed: {
    redirect() {
      return (
        this.$route.query.redirect &&
        decodeURIComponent(this.$route.query.redirect)
      );
    },
    isCallback() {
      return Boolean(this.$route.query.callback);
    }
  }
};
</script>
