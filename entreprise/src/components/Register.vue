<template>
  <v-dialog v-model="dialog" width="500">
    <template v-slot:activator="{ on, attrs }">
      <v-btn color="primary" v-bind="attrs" v-on="on"> Register </v-btn>
    </template>

    <v-card>
      <v-card-title class="text-h5 grey lighten-2"> Register </v-card-title>

      <v-card-text>
        <v-form>
          <v-container fluid>
            <v-row>
              <v-col cols="12" sm="6">
                <v-text-field
                  v-model="nom"
                  type="text"
                  label="Email"
                ></v-text-field>
              </v-col>
              <v-col cols="12" sm="6">
                <v-text-field
                  v-model="email"
                  type="email"
                  label="Email"
                ></v-text-field>
              </v-col>

              <v-col cols="12" sm="6">
                <v-text-field
                  type="password"
                  name="input-10-2"
                  label="Password"
                  hint="At least 8 characters"
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
        <v-btn color="primary" text @click="register">Register</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  data() {
    return {
      dialog: false,
      nom: null,
      email: null,
      password: null,
    };
  },
  methods: {
    register() {
      let formData = new FormData();
      formData.append("nom", this.nom);
      formData.append("email", this.email);
      formData.append("password", this.password);

      this.$router.push("/finish-profil");
      this.dialog = false;
    },
  },
};
</script>