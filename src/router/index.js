import { createRouter, createWebHistory } from 'vue-router'
import { authGuard  } from "@/_helpers";

import Layout from '../views/layouts/Layout.vue'

import Login from '@/views/pages/Login.vue'
import Reset from '@/views/pages/ResetPassword.vue'
import Page404 from '@/views/pages/Page404.vue'

import Home from '@/views/pages/PageTable/Dashboard.vue'
import Avancement from '@/views/pages/PageTable/Avancement.vue'
import Contractuel from '@/views/pages/PageTable/Contractuel.vue'
import Retraite from '@/views/pages/PageTable/Retraite.vue'
import Profile from '@/views/pages/Profile.vue'
import Import from '@/views/pages/ImportFile.vue'
import UserListe from '@/views/pages/Utilisateur/UserListe.vue'


const routes = [
  {
    // beforeEnter:authGuard.Connect,
    path: '/',
    name: 'Home',
    component: Layout,
    children:[
      { path:'/', name:'Home', component:Home },
      { path:'/avancement', name:'Avancement', component:Avancement },
      { path:'/contractuel', name:'Contractuel', component:Contractuel },
      { path:'/retraite', name:'Retraite', component:Retraite },
      { path:'/profile', name:'Profile', component:Profile },
      { path:'/import', name:'ImportFile', component:Import },
      {
        // beforeEnter:authGuard.User,
        path: '/user',
        name: 'User',
        component: UserListe
      },
    ]

  },
   {
    beforeEnter:authGuard.Deconnect,
    path: '/login',
    name: 'Login',
    component: Login
  },
  {
    beforeEnter:authGuard.Deconnect,
    path: '/reset',
    name: 'Reset',
    component: Reset
  },
  {
    path:'/:pathMatch(.*)*',
    name: 'Page404',
    component: Page404
  },
  
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
