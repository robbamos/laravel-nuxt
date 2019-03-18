<template>
  <v-layout align-center justify-center>
    <v-flex xs12 sm8 md4>
      <v-card class="elevation-12">
        <v-toolbar dark color="primary">
          <v-toolbar-title>Login</v-toolbar-title>
        </v-toolbar>
        <v-card-text>
          <v-alert v-model="failed" type="error" :dismissible="true">{{ error }}</v-alert>
          <v-form
            ref="form"
            v-model="valid"
            lazy-validation
            @submit.prevent="login"
            @keyup.enter.native="login"
          >
            <v-text-field v-model="email" :rules="emailRules" label="E-mail" required></v-text-field>
            <v-text-field
              v-model="password"
              :append-icon="show1 ? 'visibility_off' : 'visibility'"
              :rules="passwordRules"
              :type="show1 ? 'text' : 'password'"
              name="input-10-1"
              label="Password"
              @click:append="show1 = !show1"
            ></v-text-field>

            <!-- <v-checkbox v-model="remember" label="Remember Me" required></v-checkbox> -->
          </v-form>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            type="submit"
            color="primary"
            :disabled="!valid || loading"
            :loading="loading"
            @click.prevent="login"
          >Login</v-btn>
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
      valid: true,
      show1: false,
      failed: false,
      error: null,
      email: "",
      password: "",
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
          data: {
            email: this.email,
            password: this.password
          }
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
