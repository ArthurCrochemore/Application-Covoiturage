import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'

import { createMemoryHistory, createRouter } from 'vue-router'

import BlocDeRecherche from './components/BlocDeRecherche.vue'
import BlocResultatRecherche from './components/BlocResultatRecherche.vue'
import BlocTrajets from './components/BlocTrajets.vue'
import CreationTrajet from './components/CreationTrajet.vue'
import Profil from './components/Profil.vue'
import Message from './components/Message.vue'
import BlocModificationProfil from './components/BlocModificationProfil.vue'
import BlocRapporterUnBug from './components/BlocRapporterUnBug.vue'

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
  { path: '/vos-trajets', component: BlocTrajets },
  { path: '/creation-trajet', component: CreationTrajet },
  { path: '/profil', component: Profil },
  { path: '/message', component: Message },
  { path: '/modification-profil', component: BlocModificationProfil,
  props: route => ({
    mail: route.query.mail,
    unite: route.query.unite,
    numPoste: route.query.numPoste,
    prenom: route.query.prenom,
    nomFamille: route.query.nomFamille,
    adressePostale: route.query.adressePostale,
    telephone: route.query.telephone
  }) },
  { path: '/rapport-bug', component: BlocRapporterUnBug }
]

const router = createRouter({
  history: createMemoryHistory(),
  routes,
})

createApp(App).use(router).mount('#app')
