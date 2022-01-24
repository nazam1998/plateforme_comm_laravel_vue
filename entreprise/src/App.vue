<template>
  <v-app>
    <v-app-bar app color="primary" dark>
      <v-toolbar-title>Todo App</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-toolbar-items>
        <login/>
        <register/>
      </v-toolbar-items>
    </v-app-bar>
    <v-main>

      <router-view />
    </v-main>
  </v-app>
</template>

<script>
import Login from '@/components/Login.vue'
import Register from '@/components/Register.vue'
export default {
  name: "App",
  components:{Login, Register},
  data: () => ({
    //
  }),
};
</script>
