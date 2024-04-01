<template>
 
  <v-app>
    <v-main>
      
      <BarreDeNavigation />
      <!-- <CreationTrajet /> -->
      <BlocDeRecherche />
    </v-main>

  </v-app>
</template>

<script setup>
import BarreDeNavigation from './components/BarreDeNavigation.vue';
import BlocDeRecherche from './components/BlocDeRecherche.vue';
import { RouterView } from 'vue-router';
import CreationTrajet from './components/CreationTrajet.vue';
  //
</script>
