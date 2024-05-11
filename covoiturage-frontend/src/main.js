import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'

import { createMemoryHistory, createRouter } from 'vue-router'

import PageDeRecherche from './components/PageDeRecherche.vue'
import PageResultatsRecherche from './components/PageResultatsRecherche.vue'
import PageTrajets from './components/PageTrajets.vue'
import PageCreationTrajet from './components/PageCreationTrajet.vue'
import PageCreationSuivant from './components/PageCreationSuivant.vue'
import PageProfil from './components/PageProfil.vue'
import PageMessage from './components/PageMessage.vue'
import PageModificationProfil from './components/PageModificationProfil.vue'
import PageRapporterUnBug from './components/PageRapporterUnBug.vue'

import PageConnexion from './components/PageConnexion.vue'
import PageInscriptionPage1 from './components/PageInscriptionPage1.vue'
import PageInscriptionPage2 from './components/PageInscriptionPage2.vue'
import PageMotDePasseOublie from './components/PageMotDePasseOublie.vue'
import PageReinitialisationMotDePasse from './components/PageReinitialisationMotDePasse.vue'

const routes = [
  { path: '/', component: PageConnexion },
  { path: '/inscription-page1', component: PageInscriptionPage1 },
  { path: '/inscription-page2', component: PageInscriptionPage2 },
  { path: '/mot-de-passe-oublie', component: PageMotDePasseOublie },
  { path: '/reinitialisation-mot-de-passe', component: PageReinitialisationMotDePasse },








  { path: '/recherche', component: PageDeRecherche,
  props: route => ({
    domiciles: route.query.domiciles,
    basesAeriennes: route.query.basesAeriennes
  }) },
  { path: '/resultat-recherche', component: PageResultatsRecherche,
  props: route => ({
    ptDepart: route.query.ptDepart,
    ptArrive: route.query.ptArrive,
    typeTrajet: route.query.typeTrajet,
    heure: route.query.heure,
    directionTrajet: route.query.directionTrajet,
    resultats : route.query.resultats
  }) },
  { path: '/vos-trajets', component: PageTrajets },
  { path: '/creation-trajet', component: PageCreationTrajet },
  { path: '/creation-suivant', component: PageCreationSuivant},
  { path: '/profil', component: PageProfil },
  { path: '/message', component: PageMessage },
  { path: '/modification-profil', component: PageModificationProfil,
  props: route => ({
    mail: route.query.mail,
    unite: route.query.unite,
    numPoste: route.query.numPoste,
    prenom: route.query.prenom,
    nomFamille: route.query.nomFamille,
    adressePostale: route.query.adressePostale,
    telephone: route.query.telephone
  }) },
  { path: '/rapport-bug', component: PageRapporterUnBug }
]

const router = createRouter({
  history: createMemoryHistory(),
  routes,
})

createApp(App).use(router).mount('#app')
