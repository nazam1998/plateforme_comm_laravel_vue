<template>
  <v-card>
    <v-card-title class="text-h5 grey lighten-2"> Contact </v-card-title>

    <v-card-text>
      <v-form>
        <v-container fluid>
          <v-row>
            <v-col cols="12" sm="6">
              <v-text-field
                v-model="nomContact"
                type="text"
                label="Nom Contact"
              ></v-text-field>
            </v-col>
            <v-col cols="12" sm="6">
              <v-text-field
                v-model="numeroContact"
                type="number"
                label="Numero Contact"
              ></v-text-field>
            </v-col>
            <v-col cols="12" sm="6">
              <v-text-field
                v-model="emailContact"
                type="email"
                label="Email Contact"
              ></v-text-field>
            </v-col>
          </v-row>
        </v-container>
      </v-form>
    </v-card-text>
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