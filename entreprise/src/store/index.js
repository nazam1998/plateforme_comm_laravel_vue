import axios from 'axios';
import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from "vuex-persistedstate";
import router from '../router';
Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    auth_token: null,
    currentUser: null,
  },
  mutations: {
    setToken(state, value) {
      state.auth_token = value;
    },
    setCurrentUser(state, value) {
      state.currentUser = value;
    },

  },
  actions: {
    login({
      commit,
      dispatch,
    }, value) {
      axios.post('/login', value).then((response) => {
        commit('setToken', response.data.data.token);
        dispatch('getUser');

      })
    },
    register({
      commit,
      dispatch
    }, value) {
      axios.post('/register', value).then((response) => {
        commit('setToken', response.data.data.token);
        dispatch('getUser');
      })
    },
    logout({
      state,
      commit
    }) {
      axios.post('/logout', {}, {
        headers: {
          Authorization: "Bearer " + state.auth_token
        }
      }).then(() => {
        commit('setToken', null);
        commit('setCurrentUser', null);
      })
    },
    async getUser({
      state,
      commit
    }) {
      await axios.get('/user', {
        headers: {
          Authorization: "Bearer " + state.auth_token
        }
      }).then((response) => {
        commit('setCurrentUser', response.data.data);
        if (response.data.data.entreprise != null) {
          router.push("/dashboard");
        }
        router.push("/finish-profil");
      }).catch((err) => {
        console.log(err);
      })
    },
    createProfil({
      dispatch,
      state
    }, value) {
      axios.post('/entreprise', value, {
        headers: {
          Authorization: "Bearer " + state.auth_token
        }
      }).then(() => {
        dispatch('getUser');
      }).catch((err) => {
        console.log(err);
      })
    }
  },
  modules: {},
  plugins: [createPersistedState({
    paths: ['currentUser', 'auth_token']
  })],
})