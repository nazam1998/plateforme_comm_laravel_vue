<template>
  <v-card>
    <v-card-text>
      <v-form>
        <v-container fluid>
          <v-row>
            <v-col :cols="'8'" sm="6">
              <v-text-field
                type="text"
                label="TVA"
                v-model="tva"
              ></v-text-field>
            </v-col>
            <v-col cols="4" v-if="tva">
              <v-btn color="primary" @click="validate">Validate</v-btn>
            </v-col>
            <v-col v-else cols="4"></v-col>
            <v-col cols="12" sm="6">
              <v-text-field
                type="text"
                label="Nom"
                :value="inputData.nom"
                disabled
              ></v-text-field>
            </v-col>

            <v-col cols="12" sm="6">
              <v-text-field
                type="text"
                label="Activite"
                :value="inputData.activite"
                disabled
              ></v-text-field>
            </v-col>
            <v-col cols="12" sm="6">
              <v-text-field
                type="text"
                label="Adresse"
                :value="inputData.adresse"
                disabled
              ></v-text-field>
            </v-col>
            <v-col cols="12" sm="6">
              <v-text-field
                type="text"
                label="Ville"
                :value="inputData.ville"
                disabled
              ></v-text-field>
            </v-col>

            <v-col cols="12" sm="6">
              <v-text-field
                type="text"
                label="Pays"
                :value="inputData.pays"
                disabled
              ></v-text-field>
            </v-col>

            <v-col cols="12" sm="6">
              <v-text-field
                type="text"
                label="Numero"
                :value="inputData.numero"
                disabled
              ></v-text-field>
            </v-col>
            <v-col cols="12" sm="6">
              <v-text-field
                type="text"
                label="Code Postal"
                :value="inputData.codePostal"
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
import axios from "axios";

export default {
  name: "FormEntreprise",
  data() {
    return {
      inputData: {},
      tva: null,
    };
  },
  methods: {
    validate() {
      // Permet récupérer les infos d'une entreprise à partir de la tva
      axios
        .get(`http://13.38.138.92/api/companies/${this.tva}/info`)
        .then((response) => {
          this.inputData = response.data.data;
          this.inputData.codePostal = response.data.data.code_postal;
          this.$emit("setInputDataEntreprise", response.data.data);
        })
        .catch(() => {});
    },
  },
};
</script>
<style>
</style>