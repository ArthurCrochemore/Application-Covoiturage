// router/index.js
import PageDetailTrajetConducteur from '@/components/PageDetailTrajetConducteur.vue'
import { createRouter, createWebHistory } from 'vue-router'
import CreationTrajet from '../components/CreationTrajet.vue'

const routes = [
  // Ajoutez ici les autres routes
  {
    path: '/creation-trajet',
    name: 'CreationTrajet',
    component: CreationTrajet
  },
  {
    path: '/detail-trajet-conducteur',
    name: 'DetailTrajetConducteur',
    component: PageDetailTrajetConducteur,
    props: true
  }
]

const router = createRouter({
    history: createWebHistory(),
    routes
  })
  
export default router