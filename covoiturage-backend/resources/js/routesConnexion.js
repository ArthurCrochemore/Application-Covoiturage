import { createRouter, createWebHistory } from 'vue-router';

import PageConnexion from './Pages/PageConnexion.vue';
import PageInscriptionPage1 from './Pages/PageInscriptionPage1.vue';
import PageInscriptionPage2 from './Pages/PageInscriptionPage2.vue';
import PageMotDePasseOublie from './Pages/PageMotDePasseOublie.vue';
import PageReinitialisationMotDePasse from './Pages/PageReinitialisationMotDePasse.vue';

const routes = [
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

const routerConnexion = createRouter({
    history: createWebHistory(),
    routes,
  });

export default routerConnexion;
