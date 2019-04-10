<template>
  <v-layout align-center justify-center>
    <v-flex xs12 sm8 md6>
      <v-card class="elevation-12">
        <v-toolbar dark color="primary">
          <v-toolbar-title>Register</v-toolbar-title>
        </v-toolbar>
        <v-card-text>
          <v-alert v-model="failed" type="error" dismissible>
            <ul style="list-style:none;">
              <li :key="i" v-for="(err, i) in errors">
                <ul style="list-style:none;">
                  <li :key="j" v-for="(message, j) in err">{{ message }}</li>
                </ul>
              </li>
            </ul>
          </v-alert>
          <v-form
            ref="registerForm"
            lazy-validation
            @submit.prevent="register()"
            @keyup.enter.native="register()"
          >
            <v-text-field v-model="user.name" :rules="rules.name" label="Name" required></v-text-field>
            <v-text-field v-model="user.email" :rules="rules.email" label="E-mail" required></v-text-field>
            <v-text-field
              v-model="user.password"
              :append-icon="passwordVisible ? 'visibility_off' : 'visibility'"
              :rules="rules.password"
              :type="passwordVisible ? 'text' : 'password'"
              label="Password"
              @click:append="passwordVisible = !passwordVisible"
            ></v-text-field>
          </v-form>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn type="submit" color="primary" @click.prevent="register()">Register</v-btn>
        </v-card-actions>
      </v-card>
    </v-flex>
  </v-layout>
</template>

<script>
export default {
  middleware: ["auth"],
  layout: "auth",
  options: {
    auth: false
  },
  head() {
    return { title: "Register" };
  },
  data() {
    return {
      passwordVisible: false,
      failed: false,
      errors: null,
      user: {
        name: "",
        email: "",
        password: ""
      },
      rules: {
        name: [v => !!v || "Name is required"],
        email: [
          v => !!v || "E-mail is required",
          v => /.+@.+/.test(v) || "E-mail must be valid"
        ],
        password: [v => !!v || "Password is required"]
      }
    };
  },
  methods: {
    register() {
      if (this.$refs.registerForm.validate()) {
        this.$api.auth
          .register(this.user)
          .then(resp => {
            console.log(resp);
            this.$auth.login({
              data: {
                email: this.user.email,
                password: this.user.password
              }
            }).then(() => {
              this.$router.replace('/dashboard')
            })
          })
          .catch(err => {
            console.log(err);
            this.failed = true;
            this.errors = errors.response.data.errors;
          });
      }
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
