<script setup>
import BarreDeNavigation from './components/BarreDeNavigation.vue'
import BlocDeRecherche from './components/BlocDeRecherche.vue'
import BlocResultatRecherche from './components/BlocResultatRecherche.vue'

</script>

<template>
  <!-- BlocResultatRecherche ptDepart = "St Avertin" ptArrive="Base Aerienne" typeTrajet= "Regulier" heure="10h50" directionTrajet="Arrivé"/ -->
  <BlocDeRecherche />
  <BarreDeNavigation />
</template>

<style scoped>
header {
  line-height: 1.5;
}

.logo {
  display: block;
  margin: 0 auto 2rem;
}

@media (min-width: 1024px) {
  header {
    display: flex;
    place-items: center;
    padding-right: calc(var(--section-gap) / 2);
  }

  .logo {
    margin: 0 2rem 0 0;
  }

  header .wrapper {
    display: flex;
    place-items: flex-start;
    flex-wrap: wrap;
  }
}
</style>
