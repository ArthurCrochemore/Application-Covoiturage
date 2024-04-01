// router/index.js
import { createRouter, createWebHistory } from 'vue-router'
import CreationTrajet from '../components/CreationTrajet.vue'

const routes = [
  // Ajoutez ici les autres routes
  {
    path: '/creation-trajet',
    name: 'CreationTrajet',
    component: CreationTrajet
  }
]

const router = createRouter({
    history: createWebHistory(),
    routes
  })
  
export default router