import { createRouter, createWebHistory } from 'vue-router'
import BlocDeRecherche from '../components/BlocDeRecherche.vue'
import BarreDeNavigation from '../components/BarreDeNavigation.vue'

const routes = [
  { path: '/', component: BlocDeRecherche },
  { path: '/barre-de-navigation', component: BarreDeNavigation }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
