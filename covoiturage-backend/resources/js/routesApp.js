// Définition des routes du vue-router de App.vue

import { createRouter, createWebHistory } from 'vue-router';

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

const routes = [
    { path: '/app', component: PageDeRecherche,
    props: route => ({
        ptDepart: route.query.ptDepart,
        ptArrive: route.query.ptArrive
  }) },
    { path: '/recherche', component: PageDeRecherche,
    props: route => ({
        ptDepart: route.query.ptDepart,
        ptArrive: route.query.ptArrive,
        booleenTrajetBaseDomicile: route.query.booleenTrajetBaseDomicile,
  }) },
  { path: '/resultat-recherche', component: PageResultatsRecherche,
    props: route => ({
      idBase: route.query.idBase,
      idDomicile: route.query.idDomicile,
      booleenTrajetBaseDomicile: route.query.booleenTrajetBaseDomicile,
      typeTrajet: route.query.typeTrajet,
      jours: route.query.jours,
      heure: route.query.heure,
      date: route.query.date
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
  { path: '/detail-trajet-conducteur', component: PageDetailTrajetConducteur,
  props: route => ({
    idTrajet: route.query.idTrajet
    })
   },
  { path: '/detail-trajet-passager', component: PageDetailTrajetPassager,
  props: route => ({
    idTrajet: route.query.idTrajet
})},
  { path: '/detail-trajet-reservation', component: PageDetailTrajetReservation,
    props: route => ({
        idTrajet: route.query.idTrajet,
        idDomicile: route.query.idDomicile
    })
   }
];

const routerApp = createRouter({
    history: createWebHistory(),
    routes,
  });

  export default routerApp;
