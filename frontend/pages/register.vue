<template>
  <v-layout align-center justify-center>
    <v-flex xs12 sm8 md4>
      <v-card class="elevation-12">
        <v-toolbar dark color="primary">
          <v-toolbar-title>Register</v-toolbar-title>
        </v-toolbar>
        <v-card-text>
          <v-alert v-model="failed" type="error" :dismissible="true">
            <ul style="list-style:none;">
              <li v-for="(err, i) in errors">
                <ul style="list-style:none;">
                  <li v-for="(message, j) in err">{{ message }}</li>
                </ul>
              </li>
            </ul>
          </v-alert>
          <v-form
            ref="form"
            v-model="valid"
            lazy-validation
            @submit.prevent="register"
            @keyup.enter.native="register"
          >
            <v-text-field v-model="user.name"  label="Name" required></v-text-field>
            <v-text-field v-model="user.email" :rules="emailRules" label="E-mail" required></v-text-field>
            <v-text-field
              v-model="user.password"
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
          <v-btn type="submit" color="primary" :disabled="loading" @click.prevent="register">Login</v-btn>
        </v-card-actions>
      </v-card>
    </v-flex>
  </v-layout>
</template>

<script>
const Cookie = process.client ? require("js-cookie") : undefined;

export default {
  middleware: "noauth",
  layout: "auth",
  head() {
    return { title: 'Login'};
  },
  data() {
    return {
      valid: true,
      show1: false,
      failed: false,
      errors: null,
      user: {
        name: "",
        email: "",
        password: "",
      },
      remember: false,
      nameRules: [
        v => !!v || "Name is required",
      ],
      emailRules: [
        v => !!v || "E-mail is required",
        v => /.+@.+/.test(v) || "E-mail must be valid"
      ],
      passwordRules: [v => !!v || "Password is required"]
    };
  },
  methods: {
    register() {
      this.$store
        .dispatch("auth/register", this.user)
        .then(response => {
          console.log(response);
          this.valid = true;
          this.$router.push("/dashboard");
        })
        .catch(errors => {
          console.log(errors);
          this.valid = false;
          this.failed = true;
          console.log(errors.response)
          this.errors = errors.response.data.errors;
        });
    },

    clear() {
      this.$refs.form.reset();
    }
  },
  computed: {
    loading() {
      return this.$store.state.auth.loading
    }
  }
};
</script>
