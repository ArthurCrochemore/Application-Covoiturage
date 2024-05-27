<template>
    <div class="trip-details">
      <button class="back-button" @click="goBack">&#8678; Retour</button>
      <h1>Trajet Passager</h1>
      <div>
        <p><span class="label">ID du trajet:</span> {{ trip.id }}</p>
        <p><span class="label">Date:</span> {{ trip.date }}</p>
        <p><span class="label">Départ:</span> {{ trip.timeDeparture }} {{ trip.from }}</p>
        <p><span class="label">Arrivée:</span> {{ trip.timeArrival }} {{ trip.to }}</p>
      </div>
      <h2 class="passengers-label">Passagers</h2>
      <div class="passenger-info" v-for="passenger in trip.passengers" :key="passenger.id">
        <p class="name"><span class="label">Nom:</span> {{ passenger.firstName }} {{ passenger.lastName }}</p>
        <p class="contact-info">
          <span class="phone"><span class="label">Téléphone:</span> {{ passenger.phone }}</span>
          <span class="route">{{ passenger.from }} - {{ passenger.to }}</span>
        </p>
      </div>
      <p class="passenger-count">{{ trip.nbPassagers }}/{{ trip.nbMaxPassagers }} passagers</p>
      <div class="action-buttons">
        <button class="reserver-button" @click="reserver">Reserver</button>
      </div>
    </div>
  </template>


  <script setup>
  import { onMounted, ref } from 'vue';
  import { useRoute, useRouter } from 'vue-router';
  import axios from 'axios'

  const props = defineProps({
        idTrajet: Int16Array,
        idDomicile: Int16Array
    })

  onMounted(() => {
    fetchTripDetails();
  });

  const fetchTripDetails = async () =>  {
    /*const tripId = route.params.id;
    trip.value = {
      id: tripId,
      date: '2024-01-16',
      timeDeparture: '08:00',
      from: 'Paris',
      timeArrival: '10:25',
      to: 'Lyon',
      passengers: [
        { id: 1, firstName: 'Arthur', lastName: 'Crochemore', phone: '0123456789', from: 'Paris', to: 'Lyon' },
        { id: 2, firstName: 'Caroline', lastName: 'Petit', phone: '9876543210', from: 'Lyon', to: 'Marseille' }
      ],
      nbPassagers: 3,
      nbMaxPassagers: 5
    };*/

    try {
        const response = await axios.get('/api/trajets/' + id)
        trip.value = response.data
    } catch (error) {
        console.error('Error fetching trajets:', error)
    }
  }

  const trip = ref({});
  const route = useRoute();
  const router = useRouter(); // Récupération du router vue-router pour la navigation



  function goBack() {
    router.back();
  }

  function reserver() {
    axios.post('/reserver-trajet', {
        Id_Passager: 1, // TODO : remplir id
        Id_Trajet: 1,
        Id_Adresse: 1
      })
      .then(response => {
        console.log(response);
        afficherMessageFunc("La demande de réservation a été envoyée", "Succès");
        router.push({
            path: '/vos-trajets'
        });
      })
      .catch(error => {
        afficherMessageFunc(error, "Erreur");
        console.error(error);
      });
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

  .reserver-button {
    padding: 10px 20px;
    margin: 0 10px;
    font-size: 1rem;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
  }
  .reserver-button {
    background-color: #f44336;
  }

  .reserver-button:hover {
    background-color: #da190b;
  }

  </style>
