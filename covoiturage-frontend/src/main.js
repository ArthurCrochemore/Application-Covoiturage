import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'

import { createMemoryHistory, createRouter } from 'vue-router'

import BlocDeRecherche from './components/BlocDeRecherche.vue'
import BlocResultatRecherche from './components/BlocResultatRecherche.vue'

const routes = [
  { path: '/', component: BlocDeRecherche },
  { path: '/resultat-recherche', component: BlocResultatRecherche,
  props: route => ({
    ptDepart: route.query.ptDepart,
    ptArrive: route.query.ptArrive,
    typeTrajet: route.query.typeTrajet,
    heure: route.query.heure,
    directionTrajet: route.query.directionTrajet
  }) },
]

const router = createRouter({
  history: createMemoryHistory(),
  routes,
})

createApp(App).use(router).mount('#app')
