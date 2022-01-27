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
      requiresFinish: true
    },
    component: () => import( /* webpackChunkName: "dashboard" */ '../views/Dashboard.vue')
  }, {
    path: '/taches',
    name: 'Taches',
    meta: {
      requiresAuth: true,
      requiresFinish: true
    },
    component: () => import( /* webpackChunkName: "taches" */ '../views/Taches.vue')
  }, {
    path: '/messages',
    name: 'Messages',
    meta: {
      requiresAuth: true,
      requiresFinish: true
    },
    component: () => import( /* webpackChunkName: "messages" */ '../views/Messages.vue')
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

router.beforeEach((to, from, next) => {

  //Vérifie si la route requiert d'être connecté 
  if (to.matched.some(record => record.meta.requiresAuth)) {

    // Si le user n'est pas connecté, il est redirigé vers la page home
    if (store.state.auth_token == null) {
      next({
        name: 'Home',
      });
    } else {
      
      // Sinon, si le user est connecté, on vérifie si la route requiert d'avoir
      // fini de compléter son profil
      if (to.matched.some(record => record.meta.requiresFinish)) {
        
        // Vérifie si le user a fini de compléter son profil
        // Si le user n'a pas d'entreprise, c'est qu'il n'a pas fini de compléter son profil
        if (!store.state.currentUser.entreprise) {
          next({
            name: 'Finish'
          })
      
          // Sinon, on le laisse continuer sa route :)
        } else {
          next()
        }
      } else {
        next()
      }
    }
  } else {
    next()
  }
})


export default router