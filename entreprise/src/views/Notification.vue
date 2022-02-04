<template>
  <div>
    <v-list>
      <v-list-item
        v-for="notif in notifications"
        :key="notif.id"
        :to="
        
          notif.type == 'App\\Notifications\\NewTaskNotification'
            ? 'taches'
            : 'messages'"
        :colors="!notif.read_at?'primary':''"
      >
      
        <div v-if="notif.type == 'App\\Notifications\\NewTaskNotification'">
          You received a new task : <span>{{ notif.data.data.task }}</span>
        </div>
        <div v-else>
          You received a new message :
          <span>{{ JSON.parse(notif.data.data).msg }}</span>
        </div>
      </v-list-item>
    </v-list>
  </div>
</template>
<script>
import { mapState } from "vuex";
import axios from "axios";
export default {
  name: "Notification",
  mounted() {
    axios
      .get("notification", {
        headers: {
          Authorization: "Bearer " + this.auth_token,
        },
      })
      .then((response) => {
        this.notifications = response.data.data;
      });

    axios
      .get("readnotification", {
        headers: {
          Authorization: "Bearer " + this.auth_token,
        },
      })
      .then(() => {});
  },
  data() {
    return {
      notifications: [],
    };
  },
  computed: {
    ...mapState(["currentUser", "auth_token"]),
  },
};
</script>
<style>
</style>