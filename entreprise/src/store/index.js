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
      dispatch
    }, value) {
      axios.post('/login', value).then((response) => {
        commit('setToken', response.data.data.token);
        dispatch('getUser');
        router.push("/finish-profil");
      })
    },
    logout({
      state
    }) {
      axios.post('/logout', {}, {
        headers: {
          Authorization: "Bearer " + state.auth_token
        }
      }).then((response) => {
        state.auth_token = null;
        state.currentUser = null;
        console.log(response)
      })
    },
    getUser({
      state,
      commit
    }) {
      axios.get('/user', {
        headers: {
          Authorization: "Bearer " + state.auth_token
        }
      }).then((response) => {
        commit('setCurrentUser', response.data.data);
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