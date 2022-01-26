import Vue from 'vue'
import VueRouter from 'vue-router'
import store from '../store'
import Home from '../views/Home.vue'

Vue.use(VueRouter)

const routes = [{
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/finish-profil',
    name: 'Finish',
    meta: {
      requiresAuth: true
    },
    component: () => import( /* webpackChunkName: "finish-profile" */ '../views/Stepper.vue')
  },
  {
    path: '/dashboard',
    name: 'Dashboard',
    meta: {
      requiresAuth: true,
      requireFinish: true
    },
    component: () => import( /* webpackChunkName: "dashboard" */ '../views/Dashboard.vue')
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})
router.beforeEach((to, from, next) => {
  if (to.name != from.name) {

    if (to.matched.some(record => record.meta.requiresAuth)) {
      if (to.name === 'Finish' && store.state.currentUser.entreprise != null) {
        next({
          name: 'Dashboard'
        });
      }
      if (store.state.auth_token == null) {
        next({
          name: 'Home',
        });
      } else {
        if (to.matched.some(record => record.meta.requireFinish)) {
          if (store.state.currentUser.entreprise == null) {

            next({
              name: 'Finish'
            })
          } else {
            next()
          }
        }
      }
    } else {
      next()
    }
  }
})
export default router