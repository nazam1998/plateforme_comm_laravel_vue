<template>
  <v-card>
    <v-card-text>
      <v-form>
        <v-container fluid>
          <v-row>
            <v-col cols="8" sm="6">
              <v-text-field
                type="text"
                label="TVA"
                v-model="tva"
              ></v-text-field>
            </v-col>
            <v-col cols="4">
              <v-btn color="primary" @click="validate">Validate</v-btn>
            </v-col>
            <v-col cols="12" sm="6">
              <v-text-field
                type="text"
                label="Nom"
                :value="nom"
                disabled
              ></v-text-field>
            </v-col>

            <v-col cols="12" sm="6">
              <v-text-field
                type="text"
                label="Activite"
                :value="activite"
                disabled
              ></v-text-field>
            </v-col>
            <v-col cols="12" sm="6">
              <v-text-field
                type="text"
                label="Adresse"
                :value="adresse"
                disabled
              ></v-text-field>
            </v-col>
            <v-col cols="12" sm="6">
              <v-text-field
                type="text"
                label="Ville"
                :value="ville"
                disabled
              ></v-text-field>
            </v-col>

            <v-col cols="12" sm="6">
              <v-text-field
                type="text"
                label="Numero"
                :value="numero"
                disabled
              ></v-text-field>
            </v-col>
            <v-col cols="12" sm="6">
              <v-text-field
                type="text"
                label="Code Postal"
                :value="codePostal"
                disabled
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
      tva: null,
      nom: null,
      adresse: null,
      activite: null,
      ville: null,
      numero: null,
      codePostal: null,
    };
  },
  methods: {
    validate() {
      
    },
  },
};
</script>
<style>
</style>