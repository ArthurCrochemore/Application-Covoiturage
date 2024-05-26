import { createApp, h } from 'vue';
import App from './App.vue';
import routerApp from './routesApp';

const app = createApp({
  render: () => h(App),
});

app.use(routerApp);
app.mount('#app');
