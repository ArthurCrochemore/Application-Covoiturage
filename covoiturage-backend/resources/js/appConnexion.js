import { createApp, h } from 'vue';
import AppConnexion from './App_Connexion.vue';
import routerConnexion from './routesConnexion';

const app = createApp({
  render: () => h(AppConnexion),
});

app.use(routerConnexion);
app.mount('#app');
