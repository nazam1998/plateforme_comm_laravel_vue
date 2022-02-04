<template>
  <div>
    <v-card>
      <v-card-title class="text-h5 grey lighten-2">Change Profile</v-card-title>
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

      <v-card-actions>
        <v-row justify="center">
          <v-col cols="12">
            <v-btn
              class="text-center mx-auto white--text"
              color="green"
              @click="send"
              >Confirm</v-btn
            >
          </v-col>
        </v-row>
      </v-card-actions>
    </v-card>
  </div>
</template>
<script>
import { mapState } from "vuex";
import axios from "axios";
export default {
  data() {
    return {
      nomContact: null,
      numeroContact: null,
      emailContact: null,
    };
  },
  mounted() {
    //   Permet d'assigner les données récupérées aux inputs pour éditer le profil
    this.nomContact = this.currentUser.entreprise.nom_contact;
    this.numeroContact = this.currentUser.entreprise.numero_contact;
    this.emailContact = this.currentUser.entreprise.email_contact;
  },
  methods: {
    send() {
        // Ne rentre dans la fonction que si les champs sont tous remplis

      if (
        this.nomContact != null &&
        this.numeroContact != null &&
        this.emailContact != null
      ) {
        let formData = {
          nom_contact: this.nomContact,
          email_contact: this.emailContact,
          numero_contact: this.numeroContact,
        };
        // Permet d'éditer le profil
        axios
          .put("entreprise/profile", formData, {
            headers: {
              Authorization: "Bearer " + this.auth_token,
            },
          })
          .then(() => {
            this.$store.dispatch("getUser");
          });
      }
    },
  },
  computed: {
    ...mapState(["auth_token", "currentUser"]),
  },
};
</script>
<style>
</style>