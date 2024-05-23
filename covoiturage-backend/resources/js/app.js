import { createInertiaApp } from '@inertiajs/vue3';
import { h, createApp } from 'vue';
import { createMemoryHistory, createRouter } from 'vue-router';
import './assets/main.css';

// Importez toutes les pages
import PageConnexion from './Pages/PageConnexion.vue';
import PageInscriptionPage1 from './Pages/PageInscriptionPage1.vue';
import PageInscriptionPage2 from './Pages/PageInscriptionPage2.vue';
import PageMotDePasseOublie from './Pages/PageMotDePasseOublie.vue';
import PageReinitialisationMotDePasse from './Pages/PageReinitialisationMotDePasse.vue';
import PageDeRecherche from './Pages/PageDeRecherche.vue';
import PageResultatsRecherche from './Pages/PageResultatsRecherche.vue';
import PageTrajets from './Pages/PageTrajets.vue';
import PageCreationTrajet from './Pages/PageCreationTrajet.vue';
import PageCreationSuivant from './Pages/PageCreationSuivant.vue';
import PageProfil from './Pages/PageProfil.vue';
import PageMessage from './Pages/PageMessage.vue';
import PageModificationProfil from './Pages/PageModificationProfil.vue';
import PageRapporterUnBug from './Pages/PageRapporterUnBug.vue';
import PageModificationTrajet from './Pages/PageModificationTrajet.vue';
import PageDetailTrajetConducteur from './Pages/PageDetailTrajetConducteur.vue';
import PageDetailTrajetPassager from './Pages/PageDetailTrajetPassager.vue';
import PageDetailTrajetReservation from './Pages/PageDetailTrajetReservation.vue';

// Définir les routes pour App_Connexion
const routesConnexion = [
  { path: '/', component: PageConnexion },
  { path: '/inscription-page1', component: PageInscriptionPage1,
  props: route => ({
    mail:  route.query.mail,
  nid:  route.query.nid
}) },
  { path: '/inscription-page2', component: PageInscriptionPage2,
  props: route => ({
    mail:  route.query.mail,
  nid:  route.query.nid,
  mdp:  route.query.mdp
}) },
  { path: '/mot-de-passe-oublie', component: PageMotDePasseOublie },
  { path: '/reinitialisation-mot-de-passe', component: PageReinitialisationMotDePasse },
];

// Définir les routes pour App
const routesApp = [
    { path: '/', component: PageDeRecherche,
  props: route => ({
    domiciles: route.query.domiciles,
    villeDomiciles: route.query.villeDomiciles,
    basesAeriennes: route.query.basesAeriennes,
    villeBases: route.query.villeBases,
    ptDepart: route.query.ptDepart,
    ptArrive: route.query.ptArrive
  }) },
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
      resultats: route.query.resultats
    })
  },
  { path: '/vos-trajets', component: PageTrajets },
  { path: '/creation-trajet', component: PageCreationTrajet },
  { path: '/creation-suivant', component: PageCreationSuivant },
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
    })
  },
  { path: '/rapport-bug', component: PageRapporterUnBug },
  { path: '/modification-trajet', component: PageModificationTrajet },
  { path: '/detail-trajet-conducteur', component: PageDetailTrajetConducteur },
  { path: '/detail-trajet-passager', component: PageDetailTrajetPassager },
  { path: '/detail-trajet-reservation', component: PageDetailTrajetReservation }
];

const routerConnexion = createRouter({
  history: createMemoryHistory(),
  routes: routesConnexion,
});

const routerApp = createRouter({
  history: createMemoryHistory(),
  routes: routesApp,
});

// Créez et configurez l'application Inertia
createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('./**/*.vue', { eager: true });
    return pages[`./${name}.vue`];
  },
  setup({ el, App, props, plugin }) {
    const app = createApp({
      render: () => h(App, props),
    });

    const appName = props.initialPage.component;

    const router = appName === 'App_Connexion' ? routerConnexion : routerApp;

    app.use(router);
    app.use(plugin);
    app.mount(el);
  },
});
