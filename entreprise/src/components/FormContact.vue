<template>
  <v-card>
    <v-card-title class="text-h5 grey lighten-2"> Login </v-card-title>

    <v-card-text>
      <v-form>
        <v-container fluid>
          <v-row>
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
                value=""
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
</template>
<script>
export default {
  name: "FormEntreprise",
  data() {
    return {
      nomContact: null,
      emailContact: null,
      numeroContact: null,
    };
  },
};
</script>
<style>
</style>