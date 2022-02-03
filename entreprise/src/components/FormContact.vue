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
                :rules="nameRules"
                label="Nom Contact"
              ></v-text-field>
            </v-col>
            <v-col cols="12" sm="6">
              <v-text-field
                v-model="numeroContact"
                :rules="numeroRules"
                type="number"
                label="Numero Contact"
                hint="At least 9 digits"
              ></v-text-field>
            </v-col>
            <v-col cols="12" sm="6">
              <v-text-field
                v-model="emailContact"
                :rules="emailRules"
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
  name: "FormContact",
  data() {
    return {
      nomContact: null,
      emailContact: null,
      numeroContact: null,
      nameRules: [
        (v) => !!v || "Le numéro est requis",
        (v) =>
          (v && v.length >= 8) || "Le nom doit contenir au moins 8 caractères",
      ],
      numeroRules: [
        (v) => !!v || "Le numéro est requis",
        (v) =>
          (v && v.length >= 9) || "Le numéro doit contenir au moins 9 chiffres",
      ],
      emailRules: [
        (v) => !!v || "E-mail is required",
        (v) => /.+@.+\..+/.test(v) || "E-mail must be valid",
      ],
    };
  },
  watch: {
    nomContact(value) {
      this.nomContact = value;
      let myData = {
        nomContact: value,
        numeroContact: this.numeroContact,
        emailContact: this.emailContact,
      };
      this.$emit("setContact", myData);
    },
    emailContact(value) {
      this.emailContact = value;
      let myData = {
        nomContact: this.nomContact,
        numeroContact: this.numeroContact,
        emailContact: value,
      };
      this.$emit("setContact", myData);
    },
    numeroContact(value) {
      this.numeroContact = value;
      let myData = {
        nomContact: this.nomContact,
        numeroContact: value,
        emailContact: this.emailContact,
      };
      this.$emit("setContact", myData);
    },
  },
};
</script>
<style>
</style>