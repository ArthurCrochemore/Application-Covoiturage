import { createApp, h } from 'vue';
import AppConnexion from './App_Connexion.vue';
import routerConnexion from './routesConnexion';

// Création de l'application de login depuis le composant App_Connexion.vue
const app = createApp({
  render: () => h(AppConnexion),
});

app.use(routerConnexion);
app.mount('#app');
