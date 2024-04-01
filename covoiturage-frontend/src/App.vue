<script setup>
import { RouterView } from 'vue-router';
import BarreDeNavigation from './components/BarreDeNavigation.vue';
</script>

<template>
  <header>
  </header>

  <main>
    
    
  </main>
  <BarreDeNavigation />
  <RouterView></RouterView>
 
  <v-app>
    <v-main>
      <BlocDeRecherche />
      <BarreDeNavigation />
      <RouterView></RouterView>
    </v-main>

  </v-app>
</template>

<script setup>
import BarreDeNavigation from './components/BarreDeNavigation.vue';
import BlocDeRecherche from './components/BlocDeRecherche.vue';

  //
</script>
>>>>>>> a09691705e34ce7e135b22394d1fbed872843ee7
