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
              <form-entreprise/>
            </v-col>
          </v-row>
        </v-card>

        <v-btn color="primary" @click="e1 = 2"> Continue </v-btn>

        <v-btn text to="/"> Cancel </v-btn>
      </v-stepper-content>

      <v-stepper-content step="2">
        <v-card class="mb-12" height="100%"></v-card>

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
import FormEntreprise from '@/components/FormEntreprise.vue';
export default {
  components:{
    FormEntreprise
  },
  data() {
    return {
      e1: 1,
    };
  },
};
</script>