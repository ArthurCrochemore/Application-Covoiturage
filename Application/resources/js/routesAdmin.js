// Définition des routes du vue-router de App_Admin.vue

import { createRouter, createWebHistory } from 'vue-router';

import PageAdmin from './Pages/PageAdmin.vue';
import PageAdminAdresse from './Pages/PageAdminAdresse.vue';
import PageAdminInscription from './Pages/PageAdminInscription.vue';
import PageAdminModificationProfil from './Pages/PageAdminModificationProfil.vue';
import PageAdminRapportBug from './Pages/PageAdminRapportBug.vue';

const routes = [
  { path: '/admin', component: PageAdmin },
  { path: '/adresse', component: PageAdminAdresse,
  props: route => ({
    idRequete: route.query.idRequete
  }) },
  { path: '/inscription', component: PageAdminInscription,
    props: route => ({
      idRequete: route.query.idRequete
    })
  },
  { path: '/modification-profil', component: PageAdminModificationProfil,
  props: route => ({
    idRequete: route.query.idRequete
  })
  },
    { path: '/rapport-bug', component: PageAdminRapportBug,
    props: route => ({
        idRequete: route.query.idRequete
    })
  }
];

const routerAdmin = createRouter({
    history: createWebHistory(),
    routes,
  });

  export default routerAdmin;
