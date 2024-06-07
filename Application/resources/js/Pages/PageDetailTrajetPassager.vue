<template>
    <div class="bloc-principal">
      <button class="back-button" @click="goBack">&#8678; Retour</button>
      <h1>Trajet Passager</h1>
      <div>
        <div class="detail"><p><span class="label">ID du trajet:</span> {{ trip.idTrajet }}</p><p class="conducteur"> <span class="label">Conducteur:</span> {{ trip.prenomConducteur }} {{ trip.nomConducteur }} </p></div>
        <div class="detail"><p><span class="label">Date:</span> {{ trip.Date_Depart }}</p><p class="conducteur"> <span class="label">Unite:</span> {{ trip.uniteConducteur }} </p></div>
        <p><span class="label">Départ:</span> {{ trip.ptDepart }} </p>
        <p><span class="label">Arrivée:</span> {{ trip.ptArrive }} </p>
      <p><span class="label"> {{ trip.heure }}</span></p>
      </div>
      <h2 class="passengers-label">Passagers</h2>
      <div class="passenger-info" v-for="passager in trip.passagers" :key="passager.id">
        <p class="name"><span class="label">Nom:</span> {{ passager.prenomPassager }} {{ passager.nomPassager }}, <span class="label"> Unite :</span> {{ passager.unite }}</p>
        <p class="contact-info">
          <span class="route"><span class="label">Ville :</span> {{ passager.adresse.Ville }} <div v-if="passager.statut == 0" class="reservation">Réservation en attente d'acceptation ...</div></span>
        </p>
      </div>
      <p class="passenger-count">{{ trip.nbPassagers }}/{{ trip.nbMaxPassagers }} passagers</p>
      <div class="action-buttons">
        <button class="delete-button" @click="annuler">Annuler</button>
      </div>
    </div>
  </template>


  <script setup>
  import { onMounted, ref } from 'vue';
import { useRoute, useRouter } from 'vue-router';
  import axios from 'axios'
  import { inject } from 'vue'

const afficherMessageFunc = inject('afficherMessageFunc'); // Fonction qui gère l'affichage de messages généraux sur App_Connexion.vue

  const trip = ref({});
  const route = useRoute();
  const router = useRouter(); // Récupération du router vue-router pour la navigation

  const props = defineProps({
    idTrajet: Number
})

  onMounted(() => {
    fetchTripDetails();
  });

  const fetchTripDetails = async () =>  {
    console.log(route.query.idTrajet)
    try {
        const response = await axios.get('/api/trajets/' + route.query.idTrajet)
        trip.value = response.data
    } catch (error) {
        console.error('Error fetching trajets:', error)
    }
  }

  function goBack() {
    router.back();
  }

  function annuler() {
    // Pas encore
  }

  </script>

  <style scoped>
  .bloc-principal {
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

  .passengers-label {
    margin-top: 20px;
    font-size: 1.7rem;
    color: #222;
    text-align: left;
    ;
  }

  .right-aligned {
    float: right;
    margin-right: 20px;
  }

  .passenger-info p {
    clear: both;
    padding-bottom: 10px;
  }

  .contact-info {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 1rem;
  }

  .phone {
    margin-right: 20px;
  }

  .route {
    text-align: left;
    flex: 1;
  }

  .detail {
    display: flex;
    justify-content: space-between;
  }

  .cercle {
    padding: 10px;
    width: 20px;
    color: #000;
    float: right;
    text-align: center;

    background: url('assets/icons/trajet-rond.png');
    background-size: 20px 20px;
    background-repeat: no-repeat;
    background-position: center;
  }

  .reservation {
    float: right;
  }

  .passenger-info {
    background-color: #f0f0f0;
    padding: 15px;
    border-radius: 8px;
    margin-top: 10px;
    border: 1px solid #ccc;
  }

  .label {
    font-weight: bold;
    color: #353535;
  }

  p {
    font-size: 1rem;
    line-height: 1.5;
    margin-bottom: 0.5rem;
  }

  .passenger-count {
    text-align: right;
    font-size: 1.1rem;
    margin: 20px 0;
    color: #333;
  }

  .action-buttons {
    margin-top: 20px;
    text-align: center;
  }

  .modify-button, .delete-button {
    padding: 10px 20px;
    margin: 0 10px;
    font-size: 1rem;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
  }

  .modify-button {
    background-color: #4CAF50;
  }

  .modify-button:hover {
    background-color: #45a049;
  }

  .delete-button {
    background-color: #f44336;
  }

  .delete-button:hover {
    background-color: #da190b;
  }

  </style>
