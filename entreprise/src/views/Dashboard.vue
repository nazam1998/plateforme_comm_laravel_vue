<template>
  <div>
    <h3 class="text-center my-4">
      Welcome to {{ currentUser.entreprise.nom }}
    </h3>
    <div class="text-center">
      <v-dialog v-model="dialog" width="500">
        <template v-slot:activator="{ on, attrs }">
          <v-btn color="red lighten-2" dark v-bind="attrs" v-on="on">
            Edit Profile
          </v-btn>
        </template>

        <edit-profile />
      </v-dialog>
    </div>
    <v-list>
      <v-list-item
        v-for="(value, key) in currentUser.entreprise"
        :key="key"
        v-show="getEntrepriseInfo(key)"
      >
        <v-row>
          <v-col cols="6" class="text-end"
            ><b>{{ replaceUnderscore(key) }}:</b></v-col
          >
          <v-col cols="6">{{ value }}</v-col>
        </v-row>
      </v-list-item>
    </v-list>
  </div>
</template>
<script>
import { mapState } from "vuex";
import EditProfile from "@/components/EditProfile";
export default {
  name: "Dashboard",
  components: {
    EditProfile,
  },
  data() {
    return { dialog: false };
  },
  methods: {
    getEntrepriseInfo(key) {
      let toExclude = ["created_at", "updated_at", "user_id"];
      return !toExclude.includes(key);
    },
    replaceUnderscore(key) {
      return key.replace(/_/g, " ");
    },
  },
  computed: {
    ...mapState(["auth_token", "currentUser"]),
  },
};
</script>
<style>
</style>