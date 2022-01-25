<template>
  <div>
    <h3>Welcome to {{currentUser.entreprise.nom}}</h3>
  </div>
</template>
<script>
import {mapState} from 'vuex';
export default {
  name: "Dashboard",
  computed:{
    ...mapState(['auth_token', 'currentUser'])
  }
};
</script>
<style>
</style>