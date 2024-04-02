<script setup>
import HelloWorld from './components/HelloWorld.vue'
import TheWelcome from './components/TheWelcome.vue'
import BarreDeNavigation from './components/BarreDeNavigation.vue'
</script>

<template>

  <v-app>
    <v-main>

      <BarreDeNavigation />
      <router-view></router-view>
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
