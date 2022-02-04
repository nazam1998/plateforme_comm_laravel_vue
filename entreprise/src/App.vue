<template>
  <v-app>
    <v-app-bar app color="primary" dark>
      <!-- Affiche le bouton du drawer seulement si le user a une entreprise -->
      <v-app-bar-nav-icon
        v-if="currentUser!=null && currentUser.entreprise"
        @click.stop="drawer = !drawer"
      ></v-app-bar-nav-icon>
      <v-spacer></v-spacer>
      <v-toolbar-items v-if="auth_token && currentUser">
        <v-btn v-if="!currentUser.entreprise" href="finish-profil">
          Finish Profile
        </v-btn>
        <v-btn v-if="currentUser.entreprise" to="notification">
          <v-icon class="mdi mdi-bell">{{ countUnread }}</v-icon></v-btn>
        <v-btn v-if="auth_token" @click="logout">Logout</v-btn>
      </v-toolbar-items>
      <v-toolbar-items v-else>
        <login />
        <register />
      </v-toolbar-items>
    </v-app-bar>
    <!-- N'affiche le navigation drawer que si on a une entreprise -->
    <div v-if="currentUser">
      <v-navigation-drawer
        v-model="drawer"
        app
        v-if="auth_token && currentUser.entreprise"
      >
        <v-list-item>
          <v-list-item-content>
            <v-list-item-title class="text-h6">Task Manager</v-list-item-title>
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
      <!-- Permet d'ajouter une notification lorsqu'on reçoit un message -->
      <transition name="scale-transition">
        <v-alert v-if="notif" outlined color="indigo" dark dismissible>
          {{ notif }}
        </v-alert>
      </transition>
      <router-view />
    </v-main>
  </v-app>
</template>

<script>
import Login from "@/components/Login.vue";
import Register from "@/components/Register.vue";
import { mapState } from "vuex";
import axios from "axios";
import Echo from "laravel-echo";
export default {
  name: "App",
  components: { Login, Register },
  data() {
    return {
      drawer: false,
      notif: "",
      notificationsTaches: null,
    };
  },
  methods: {
    logout() {
      this.$store.dispatch("logout");
      if (this.$route.name !== "Home") {
        this.$router.push("/");
      }
    },
  },
  mounted() {
    if (this.currentUser) {

      // Permet de créer un channel privé pour l'utilisateur connecté
      let echo = new Echo({
        broadcaster: "pusher",
        key: "local",
        wsHost: "127.0.0.1",
        wsPort: 6001,
        wssPort: 6001,
        forceTLS: false,
        disableStats: true,
        authorizer: (channel) => {
          return {
            authorize: (socketId, callback) => {
              axios({
                method: "POST",
                url: "http://127.0.0.1:8000/api/broadcasting/auth",
                data: {
                  socket_id: socketId,
                  channel_name: channel.name,
                },
                headers: {
                  Authorization: "Bearer " + this.auth_token,
                },
              })
                .then((response) => {
                  callback(false, response.data);
                })
                .catch((error) => {
                  callback(true, error);
                });
            },
          };
        },
      });
      // Permet de récupérer les notifications du user connecté
      axios
        .get("notification", {
          headers: {
            Authorization: "Bearer " + this.auth_token,
          },
        })
        .then((response) => {
          this.notificationsTaches = response.data.data;
        });
        // Permet de se connecter au channel privé des notifications
      echo
        .private(`App.Models.User.${this.currentUser.id}`)
        .notification((message) => {
          this.notif = JSON.parse(message.data).msg;
          // Fais disparaître la notification après 3s
          setTimeout(() => {
            this.notif = null;
          }, 3000);
        });
    }
  },
  computed: {
    // Permet de récupérer le nombre de notifications non lues
    
    countUnread() {
      if (this.notificationsTaches) {
        return this.notificationsTaches.filter((elem) => {
          return !elem.read_at;
        }).length;
      }
      return 0;
    },
    ...mapState(["currentUser", "auth_token"]),
  },
};
</script>

<style scoped>
</style>