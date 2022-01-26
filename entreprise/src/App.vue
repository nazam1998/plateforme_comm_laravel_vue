<template>
  <v-app>
    <v-app-bar app color="primary" dark>
      <v-toolbar-title>Todo App</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-toolbar-items v-if="auth_token && currentUser">
        <v-btn v-if="!currentUser.entreprise" href="finish-profil">
          Finish Profile
        </v-btn>
        <v-btn v-if="auth_token" @click="logout">Logout</v-btn>
      </v-toolbar-items>
      <v-toolbar-items v-else>
        <login />
        <register />
      </v-toolbar-items>
    </v-app-bar>
    <div v-if="currentUser">
      <v-navigation-drawer
        app
        permanent
        v-if="auth_token && currentUser.entreprise"
      >
        <v-list-item>
          <v-list-item-content>
            <v-list-item-title class="text-h6">Task Manger</v-list-item-title>
            <v-list-item-subtitle>{{
              currentUser.entreprise.nom
            }}</v-list-item-subtitle>
          </v-list-item-content>
        </v-list-item>
        <v-divider></v-divider>
        <v-list dense nav>
          <v-list-item to="/dashboard">Dashboard</v-list-item>
          <v-list-item to="/taches">Taches</v-list-item>
          <v-list-item to="/messages">Messages</v-list-item>
        </v-list>
      </v-navigation-drawer>
    </div>
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
