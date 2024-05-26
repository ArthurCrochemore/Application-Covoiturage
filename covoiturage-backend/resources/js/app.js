import { createInertiaApp } from '@inertiajs/vue3';
import { h, createApp } from 'vue';
import { createMemoryHistory, createRouter } from 'vue-router';
import { routesConnexion } from './routesConnexion';
import { routesApp } from './routesApp';
import './assets/main.css';

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
