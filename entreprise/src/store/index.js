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
      state
    }, value) {
      axios.post('/login', value).then((response) => {
        commit('setToken', response.data.data.token);
        dispatch('getUser');
        if(state.currentUser.entreprise != null){
          
          router.push("/dashboard");
        }
        router.push("/finish-profil");
      })
    },
    register({
      commit,
      dispatch
    }, value) {
      axios.post('/register', value).then((response) => {
        commit('setToken', response.data.data.token);
        dispatch('getUser');
        router.push("/finish-profil");
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
      }).then((response) => {
        commit('setToken', null);
        commit('setCurrentUser', null);
        console.log(response)
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
      }).catch((err) => {
        console.log(err);
      })
    },
    createProfil({
      commit,
      state
    }, value) {
      axios.post('/entreprise', value, {
        headers: {
          Authorization: "Bearer " + state.auth_token
        }
      }).then((response) => {
        commit('setCurrentUser', response.data);
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