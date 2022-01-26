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
                hint="At least 9 digits"
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
  name: "FormContact",
  data() {
    return {
      nomContact: null,
      emailContact: null,
      numeroContact: null,
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