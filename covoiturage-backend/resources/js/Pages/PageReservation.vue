<script setup>
  import { onMounted, ref } from 'vue';
  import { useRoute, useRouter } from 'vue-router';
  import axios from 'axios'
  import { inject } from 'vue'

  const afficherMessageFunc = inject('afficherMessageFunc'); // Fonction qui gère l'affichage de messages généraux sur App_Connexion.vue


const reservation = ref({});
const route = useRoute();
const router = useRouter(); // Récupération du router vue-router pour la navigation

const props = defineProps({
    idReservation: Number
})

onMounted(() => {
  fetchTripDetails();
});

const fetchTripDetails = async () =>  {
    try {
        const response = await axios.get('/reservation/' + route.query.idReservation)
        reservation.value = response.data
    } catch (error) {
        console.error('Error fetching trajets:', error)
    }
  }

function goBack() {
  router.back();
}

</script>

<template>
    <div class="bloc-principal">
        <button class="back-button" @click="goBack">&#8678; Retour</button>

        <!-- TODO : Creer l'interface -->

    </div>
</template>

<style scoped>
</style>
