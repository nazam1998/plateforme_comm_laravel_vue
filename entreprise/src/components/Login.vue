<template>
  <v-dialog v-model="dialog" width="500">
    <template v-slot:activator="{ on, attrs }">
      <v-btn color="primary" v-bind="attrs" v-on="on"> Login </v-btn>
    </template>

    <v-card>
      <v-card-title class="text-h5 grey lighten-2"> Login</v-card-title>

      <v-card-text>
        <v-form>
          <v-container fluid>
            <v-row>
              <v-col cols="12" sm="6">
                <v-text-field
                  v-model="email"
                  type="email"
                  label="Email"
                  :error-messages="msg ? msg.errors.email : ''"
                ></v-text-field>
              </v-col>

              <v-col cols="12" sm="6">
                <v-text-field
                  type="password"
                  name="input-10-2"
                  label="Password"
                  hint="At least 8 characters"
                  :error-messages="msg ? msg.errors.password : ''"
                  v-model="password"
                  class="input-group--focused"
                ></v-text-field>
              </v-col>
            </v-row>
          </v-container>
        </v-form>
      </v-card-text>

      <v-divider></v-divider>

      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="primary" text @click="login">Login</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
import { mapState } from "vuex";
export default {
  data() {
    return {
      dialog: false,
      email: null,
      password: null,
    };
  },
  methods: {
    login() {
      let formData = new FormData();
      formData.append("email", this.email);
      formData.append("password", this.password);
      this.$store.dispatch("login", formData);

      this.dialog = false;
    },
  },
  computed: {
    ...mapState(["msg"]),
  },
};
</script>