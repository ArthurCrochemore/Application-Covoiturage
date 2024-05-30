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

function accepter() {
    try {
        axios.post('/accepter-reservation/' + route.query.idReservation, {
        });
        afficherMessageFunc("La reservation a ete acceptée", "Succès");
        goBack();
    } catch (error) {
        afficherMessageFunc("Erreur lors de l'acceptation de la réservation", "Erreur");
    }
}

function refuser() {
    try {
        axios.post('/refuser-reservation/' + route.query.idReservation, {
        });
        afficherMessageFunc("La reservation a ete refusée", "Succès");
        goBack();
    } catch (error) {
        afficherMessageFunc("Erreur lors du refus de la réservation", "Erreur");
    }
}

</script>

<template>
    <div class="bloc-principal">
        <button class="back-button" @click="goBack">&#8678; Retour</button>

        <h1>Détails de la Réservation</h1>
        <div>
        <div class="detail">
            <p><span class="label">Nom:</span> {{ reservation.nomPassager }}</p>
            <p><span class="label">Prénom:</span> {{ reservation.prenomPassager }}</p>
        </div>
        <div class="detail">
            <p><span class="label">Unité:</span> {{ reservation.unite }}</p>
            <p><span class="label">Domicile:</span> {{ reservation.domicile }}</p>
        </div>
        </div>
        <div class="boutons">
            <div class="accepter"
        @click="accepter"><p class="intitule-accepter">Accepter</p></div>
            <div class="refuser"
        @click="refuser"><p class="intitule-refuser">Refuser</p></div>
      </div>
    </div>
</template>

<style scoped>
.bloc-principal {
    border-radius: 40px;
    padding: 20px;
    overflow-y: auto;
    color: black;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.back-button {
    align-self: flex-start;
    margin-bottom: 1rem;
    cursor: pointer;
    background: none;
    border: none;
    color: #555;
    font-size: 1rem;
    font-weight: bold;
  }

  h1 {
    margin-bottom: 20px;
    color: #222;
  }

  .detail {
    display: flex;
    justify-content: space-between;
    margin-bottom: 1rem;
  }

  .label {
    font-weight: bold;
    color: #353535;
  }

  .boutons {
    display: flex;
    flex-direction: row;
    width : 80%;
    margin-left : 10%;
  }

  .accepter, .refuser {
        width: 120px;
        height: 35px;
        margin: auto;
        border-radius: 10px;
        text-align: center;
    }

  .accepter {
    background-color: green;
  }

  .refuser {
    background-color: red;
  }

  p {
    font-size: 1rem;
    line-height: 1.5;
    margin-bottom: 0.5rem;
  }
</style>
