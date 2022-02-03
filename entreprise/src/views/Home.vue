<template>
  <v-container>
    <h2 class="text-center">Entreprise Communication Management Platform</h2>
    <v-list class="my-10">
      <v-list-item>
        <v-list-item-content>
          <h3>You must first login to access any of the following feature</h3>
        </v-list-item-content>
      </v-list-item>
      <v-list-item>
        <v-list-item-content class="font-weight-bold">
          Chat System:
          <v-list>
            <v-list-item>Access to a real time chat with the admin</v-list-item>
            <v-list-item>Get real time notification when you receive a message</v-list-item>
          </v-list>
        </v-list-item-content>
      </v-list-item>
      <v-list-item>
        <v-list-item-content class="font-weight-bold">
          Task System:
          <v-list>
            <v-list-item>You will get tasks to do from the admin</v-list-item>
            <v-list-item>You can set a task to done or open state</v-list-item>
            <v-list-item>Get a notification when you get a task from the admin</v-list-item>
            <v-list-item>Each day at 9pm, you will get an email with all the remaining tasks</v-list-item>
          </v-list>
        </v-list-item-content>
      </v-list-item>
    </v-list>
  </v-container>
</template>

<script>
export default {
  name: "Home",
};
</script>
