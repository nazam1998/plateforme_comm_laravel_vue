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
    msg: ''
  },
  mutations: {
    setToken(state, value) {
      state.auth_token = value;
    },
    setCurrentUser(state, value) {
      state.currentUser = value;
    },
    setMsg(state, value) {
      state.msg = value;
    }
  },
  actions: {
    login({
      commit,
      dispatch,
    }, value) {
      axios.post('/login', value).then((response) => {
        commit('setToken', response.data.data.token);

        dispatch('getUser');

      }).catch((err) => {
        commit('setMsg', err.response.data)
      })
    },
    register({
      commit,
      dispatch
    }, value) {
      axios.post('/register', value).then((response) => {
        commit('setToken', response.data.data.token);
        dispatch('getUser');
      }).catch((err) => {
        commit('setMsg', err.response.data)

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
        // 
        if (response.data.data.entreprise != null) {
          if (router.name != "Dashboard") {
            router.push("/dashboard");
          }
        } else if (router.name == "Dashboard") {
          router.push('/')
        } else {
          router.push("/finish-profil");
        }
      }).catch((err) => {
        console.log(err);
      })
    },
  },
  modules: {},
  plugins: [createPersistedState({
    paths: ['currentUser', 'auth_token']
  })],
})