import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'

import { createMemoryHistory, createRouter } from 'vue-router'
import { createInertiaApp } from '@inertiajs/vue3'

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
    villeDomiciles: route.query.villeDomiciles,
    basesAeriennes: route.query.basesAeriennes,
    villeBases: route.query.villeBases,
    ptDepart: route.query.ptDepart,
    ptArrive: route.query.ptArrive
  }) },
  { path: '/resultat-recherche', component: PageResultatsRecherche,
  props: route => ({
    domicile: route.query.domicile,
    villeDomicile: route.query.villeDomicile,
    base: route.query.base,
    villeBase: route.query.villeBase,
    booleenTrajetBaseDomicile: route.query.booleenTrajetBaseDomicile,
    typeTrajet: route.query.typeTrajet,
    heure: route.query.heure,
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

//createApp(App).use(router).mount('#app')

// Initialize the Inertia app alongside your Vue Router
createInertiaApp({
  // Inertia setup options
  resolve: name => {
    const pages = import.meta.glob('./components/*.vue', { eager: true })
    return pages[`./Pages/${name}.vue`]
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(router) // Add Vue Router to the app instance
      .mount(el)
  },
})
