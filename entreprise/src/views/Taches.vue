<template>
  <div>
    <h4>Page taches</h4>
    <v-container v-if="taches">
      <v-simple-table>
        <template v-slot:default>
          <thead>
            <tr>
              <th class="text-left">Tache</th>
              <th class="text-left">Statut</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="tache in taches" :key="tache.id">
              <td>{{ tache.tache }}</td>
              <td>
                <v-btn
                  @click="setTache(tache)"
                  :color="tache.statut_id == 1 ? 'red' : 'green'"
                  ><v-icon
                    :class="{
                      mdi: true,
                      'mdi-check': tache.statut_id == 2,
                      'mdi-checkbox-blank-circle-outline': tache.statut_id == 1,
                    }"
                  ></v-icon
                  >{{ tache.statut.nom }}</v-btn
                >
              </td>
            </tr>
          </tbody>
        </template>
      </v-simple-table>
    </v-container>
  </div>
</template>
<script>
import axios from "axios";
import { mapState } from "vuex";
export default {
  name: "Taches",
  mounted() {
    this.getTaches();
  },
  methods: {
    setTache(tache) {
      let data = {
        tache_id: tache.id,
        statut_id: tache.statut_id == 1 ? 2 : 1,
      };
      axios
        .post("tache", data, {
          headers: {
            Authorization: "Bearer " + this.auth_token,
          },
        })
        .then(() => {
          tache.statut_id = tache.statut_id == 1 ? 2 : 1;
          this.getTaches();
        });
    },
    getTaches() {
      axios
        .get("/taches", {
          headers: {
            Authorization: "Bearer " + this.auth_token,
          },
        })
        .then((response) => {
          console.log(response.data);
          this.taches = response.data.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
  data() {
    return {
      taches: null,
    };
  },
  computed: {
    ...mapState(["auth_token"]),
  },
};
</script>
<style>
</style>