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
        <v-btn color="primary" to="dashboard"> Complete </v-btn>
      </v-stepper-content>
    </v-stepper-items>
  </v-stepper>
</template>
<script>
import { mapState } from "vuex";
import axios from "axios";
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
        let formData = new FormData();
        formData.append("tva", this.inputData.tva);
        formData.append("nom", this.inputData.nom);
        formData.append("adresse", this.inputData.adresse);
        formData.append("activite", this.inputData.activite);
        formData.append("ville", this.inputData.ville);
        formData.append("pays", this.inputData.pays);
        formData.append("numero", this.inputData.numero);
        formData.append("code_postal", this.inputData.codePostal);
        formData.append("nom_contact", this.inputData.nomContact);
        formData.append("email_contact", this.inputData.emailContact);
        formData.append("numero_contact", this.inputData.numeroContact);

        axios
          .post("/entreprise", formData, {
            headers: {
              Authorization: "Bearer " + this.auth_token,
            },
          })
          .then(() => {
            this.$store.dispatch("getUser");
            this.e1 = 3;
            Object.keys(this.inputData).forEach(key=> this.inputData[key]= null)
          })
          .catch((err) => {
            console.log(err);
          });
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
    ...mapState(["auth_token"]),
  },
};
</script>