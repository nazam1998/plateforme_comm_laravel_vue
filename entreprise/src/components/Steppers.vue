<template>
  <v-stepper v-model="e1">
    <v-stepper-header>
      <v-stepper-step :complete="e1 > 1" step="1"> Profil </v-stepper-step>
      <v-divider></v-divider>

      <v-stepper-step :complete="e1 > 2" step="2">
        Contact Information
      </v-stepper-step>
      <v-divider></v-divider>

      <v-stepper-step step="3">Completed</v-stepper-step>
    </v-stepper-header>

    <v-stepper-items>
      <v-stepper-content step="1">
        <v-card class="mb-12" height="100%">
          <v-row>
            <v-col cols="12">
              <form-entreprise @setInputDataEntreprise="setInputDataEntreprise"/>
            </v-col>
          </v-row>
        </v-card>

        <v-btn color="primary" v-if="inputData.nom" @click="e1 = 2"> Continue </v-btn>

        <v-btn text to="/"> Cancel </v-btn>
      </v-stepper-content>

      <v-stepper-content step="2">
        <v-card class="mb-12" height="100%">
          <form-contact />
        </v-card>

        <v-btn color="primary" @click="e1 = 3"> Continue </v-btn>

        <v-btn @click="e1--" text> Cancel </v-btn>
      </v-stepper-content>

      <v-stepper-content step="3">
        <v-card class="mb-12" height="100%"></v-card>
        <v-btn color="primary" to="/dashboard"> Finish </v-btn>
      </v-stepper-content>
    </v-stepper-items>
  </v-stepper>
</template>
<script>
import FormEntreprise from "@/components/FormEntreprise.vue";
import FormContact from "@/components/FormContact.vue";
export default {
  components: {
    FormEntreprise,
    FormContact,
  },
  data() {
    return {
      e1: 1,
      inputData: {},
    };
  },
  methods: {
    setInputDataEntreprise(value) {
      this.inputData.tva = value.tva;
      this.inputData.nom = value.nom;
      this.inputData.adresse = value.adresse;
      this.inputData.activite = value.activite;
      this.inputData.ville = value.ville;
      this.inputData.numero = value.numero;
      this.inputData.codePostal = value.codePostal;
    },

    setInputDataContact(value) {
      this.inputData.nomContact = value.nomContact;
      this.inputData.numeroContact = value.numeroContact;
      this.inputData.emailContact = value.emailContact;
    },
  },
};
</script>