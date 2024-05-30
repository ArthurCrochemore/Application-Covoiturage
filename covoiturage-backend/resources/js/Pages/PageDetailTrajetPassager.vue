<template>
    <div class="trip-details">
      <button class="back-button" @click="goBack">&#8678; Retour</button>
      <h1>Trajet Passager</h1>
      <div>
        <p><span class="label">ID du trajet:</span> {{ trip.idTrajet }}</p>
        <p><span class="label">Date:</span> {{ trip.Date_Depart }}</p>
        <p><span class="label">Départ:</span> {{ trip.ptDepart }} </p>
        <p><span class="label">Arrivée:</span> {{ trip.ptArrive }} </p>
      </div>
      <h2 class="passengers-label">Passagers</h2>
      <div class="passenger-info" v-for="passenger in trip.passengers" :key="passenger.id">
        <p class="name"><span class="label">Nom:</span> {{ passenger.prenomPassager }} {{ passenger.nomPassager }}</p>
        <p class="contact-info">
          <span class="phone"><span class="label">Téléphone:</span> {{ passenger.Numero_De_Telephone }}</span>
          <!--span class="route">{{ passenger.from }} - {{ passenger.to }}</span-->
        </p>
      </div>
      <p class="passenger-count">{{ trip.nbPassagers }}/{{ trip.nbMaxPassagers }} passagers</p>
      <div class="action-buttons">
        <button class="modify-button" @click="modifyTrip">Modifier</button>
        <button class="delete-button" @click="deleteTrip">Supprimer</button>
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

  function modifyTrip() {
    // Pas encore
  }

  function deleteTrip() {
    // Slay mais pas encore
  }

  </script>

  <style scoped>
  .trip-details {
    width: 60%;
    height: auto;
    position: fixed;
    top: 150px;
    bottom: 150px;
    left: 20%;
    display: flex;
    flex-direction: column;
    background-color: white;
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
    text-align: right;
    flex: 1;
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
