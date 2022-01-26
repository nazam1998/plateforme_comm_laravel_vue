<template>
  <v-app>
    <v-app-bar app color="primary" dark>
      <v-toolbar-title>Todo App</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-toolbar-items>
        <login v-if="!auth_token" />
        <register v-if="!auth_token" />
        <v-btn v-if="auth_token" @click="logout">Logout</v-btn>
      </v-toolbar-items>
    </v-app-bar>
    <v-main>
      <router-view />
    </v-main>
  </v-app>
</template>

<script>
import Login from "@/components/Login.vue";
import Register from "@/components/Register.vue";
import { mapState } from "vuex";
export default {
  name: "App",
  components: { Login, Register },
  data: () => ({
    //
  }),
  methods: {
    logout() {
      this.$store.dispatch("logout");
      if (this.$route.name !== "Home") {
        this.$router.push("/");
      }
    },
  },
  computed: {
    ...mapState(["currentUser", "auth_token"]),
  },
};
</script>
