import { createApp, h } from 'vue';
import App_Admin from './App_Admin.vue';
import routerAdmin from './routesAdmin.js';

// Création de l'application depuis le composant App_Admin.vue
const app = createApp({
  render: () => h(App_Admin),
});

app.use(routerAdmin);
app.mount('#app');
