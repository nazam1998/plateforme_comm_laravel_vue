<template>
  <v-container class="pa-0 elevation-4" height="100%">
    <v-card flat class="fill-height">
      <v-divider class="my-0" />
      <v-card-text class="flex-grow-1 fill-height">
        <div
          v-for="msg in messages"
          :class="{
            'd-flex flex-row-reverse': msg.author_id == currentUser.id,
          }"
          :key="msg.id"
        >
          <v-menu offset-y>
            <template v-slot:activator="{ on }">
              <v-hover>
                <v-chip
                  :color="msg.author_id == currentUser.id ? 'primary' : ''"
                  dark
                  style="height: auto; white-space: normal"
                  class="pa-4 mb-2"
                  v-on="on"
                >
                  {{ msg.msg }}
                  <sub class="ml-2" style="font-size: 0.5rem">{{
                    msg.created_at
                  }}</sub>
                </v-chip>
              </v-hover>
            </template>
          </v-menu>
        </div>
      </v-card-text>
      <v-card-actions
        ><v-text-field
          v-model="inputMsg"
          label="type_a_message"
          type="text"
          no-details
          @click:append="send"
          @keyup.enter="send"
          outlined
          append-icon="mdi mdi-send"
      /></v-card-actions>
    </v-card>
  </v-container>
</template>
<script>
import axios from "axios";
import { mapState } from "vuex";
export default {
  name: "Messages",
  data() {
    return {
      messages: null,
      inputMsg: null,
    };
  },
  mounted() {
    this.getMsg();
  },
  methods: {
    send() {
      let data = {
        msg: this.inputMsg,
      };
      axios
        .post("chat", data, {
          headers: {
            Authorization: "Bearer " + this.auth_token,
          },
        })
        .then(() => {
          this.getMsg();
          this.inputMsg = null
        });
    },
    getMsg() {
      axios
        .get("chat", {
          headers: {
            Authorization: "Bearer " + this.auth_token,
          },
        })
        .then((response) => {
          this.messages = response.data.data;
        });
    },
  },
  computed: {
    ...mapState(["auth_token", "currentUser"]),
  },
};
</script>
<style>
</style>