import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import vuetify from './plugins/vuetify'

Vue.config.productionTip = false
window.axios = require('axios');
window.axios.defaults.baseURL = "http://127.0.0.1:8000/api/v1/"
Vue.mixin({
  data: function() {
    return {
      get storageUrl() {
        return "http://127.0.0.1:8000/storage/";
      }
    }
  }
})
new Vue({
  router,
  store,
  vuetify,
  render: h => h(App)
}).$mount('#app')
