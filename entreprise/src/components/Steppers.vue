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
              <form-entreprise
                @setInputDataEntreprise="setInputDataEntreprise"
              />
            </v-col>
          </v-row>
        </v-card>
        <v-btn color="primary" v-if="inputData.nom != null" @click="e1 = 2">
          Continue
        </v-btn>
      </v-stepper-content>

      <v-stepper-content step="2">
        <v-card class="mb-12" height="100%">
          <form-contact @setContact="setInputDataContact" />
        </v-card>

        <v-btn color="primary" @click="setProfil" v-if="checkContactDone">
          Finish
        </v-btn>
      </v-stepper-content>
      <v-stepper-content step="3">
        <v-card class="mb-12" height="100%">
          Your Profil has been successfully completed !
        </v-card>
        <v-btn color="primary" to="/dashboard"> Complete </v-btn>
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
      inputData: {
        tva: null,
        nom: null,
        adresse: null,
        activite: null,
        ville: null,
        pays: null,
        numero: null,
        codePostal: null,
        nomContact: null,
        numeroContact: null,
        emailContact: null,
      },
    };
  },
  methods: {
    setInputDataEntreprise(value) {
      this.$set(this.inputData, "tva", value.tva);
      this.$set(this.inputData, "nom", value.nom);
      this.$set(this.inputData, "adresse", value.adresse);
      this.$set(this.inputData, "activite", value.activite);
      this.$set(this.inputData, "ville", value.ville);
      this.$set(this.inputData, "pays", value.pays);
      this.$set(this.inputData, "numero", value.numero);
      this.$set(this.inputData, "codePostal", value.codePostal);
    },
    setInputDataContact(value) {
      this.$set(this.inputData, "nomContact", value.nomContact);
      this.$set(this.inputData, "numeroContact", value.numeroContact);
      this.$set(this.inputData, "emailContact", value.emailContact);
    },
    setProfil() {
      if (this.checkContactDone) {
        this.$store.dispatch("createProfil", this.inputData);
        this.e1 = 3;
      }
    },
  },
  computed: {
    checkContactDone() {
      return (
        this.inputData.nomContact != null &&
        this.inputData.numeroContact != null &&
        this.inputData.emailContact != null
      );
    },
  },
};
</script>