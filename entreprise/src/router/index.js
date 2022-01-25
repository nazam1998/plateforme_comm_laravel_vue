import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/finish-profil',
    name: 'Finish',
    meta:{
      requireAuth: true
    },
    component: () => import(/* webpackChunkName: "finish-profile" */ '../views/Stepper.vue')
  },
  {
    path: '/dashboard',
    name: 'Dashboard',
    meta:{
      requireAuth: true,
      requireFinish: true
    },
    component: () => import(/* webpackChunkName: "dashboard" */ '../views/Dashboard.vue')
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
