<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';

const passengerTrips = ref([
  { id: 1, date: 'Lundi 16 Janvier', time: '8h00', from: 'Paris', to: 'Base Aérienne', person: 'Arthur Crochemore' },
  { id: 2, date: 'Mardi 17 Janvier', time: '10h30', from: 'Base Aérienne', to: 'Nice', person: 'Caroline Petit' }
])

const driverTrips = ref([
  { id: 1, date: 'Mercredi 18 Janvier', time: '8h00', from: 'Base Aérienne', to: 'Paris', passengers: '2/2', status: 'Complet' },
  { id: 2, date: 'Jeudi 19 Janvier', time: '10h40', from: 'Nice', to: 'Base Aérienne', passengers: '1/3', status: 'Places disponibles' }
])

const proposedTrips = ref([
  { id: 1, date: 'Venndredi 20 Janvier', time: '8h00', from: 'Base Aérienne', to: 'Base Terrestre', passengers: '0/5', status: 'En ligne' },


])

const router = useRouter() // Récupération du router vue-router pour la navigation

function goToConductorDetails(tripId) {
    router.push({path: '/detail-trajet-conducteur', params: { id: tripId } });
}

function goToPassengerDetails(tripId) {
    router.push({path: '/detail-trajet-passager', params: { id: tripId } });
}

function goToProposedDetails(tripId) {
  router.push({path: '/detail-trajet-conducteur', params: { id: tripId } });
}


</script>

<template>
    <div class="bloc-vos-trajets">
      <section>
        <h2>Trajets Passagers</h2>
        <div v-for="trip in passengerTrips" :key="trip.id" class="trip-item" @click="goToPassengerDetails(trip.id)">
          <div class="trip-date-time"><b>{{ trip.date }} à {{ trip.time }}</b></div>
          <div class="trip-details">
            <div class="trip-route">{{ trip.from }} - {{ trip.to }}</div>
            <div class="trip-person">Avec {{ trip.person }}</div>
          </div>
        </div>
      </section>
      <section>
        <h2>Trajets Conducteurs</h2>
        <div v-for="trip in driverTrips" :key="trip.id" class="trip-item" @click="goToConductorDetails(trip.id)">
          <div class="trip-date-time"><b>{{ trip.date }} à {{ trip.time }}</b></div>
          <div class="trip-details">
            <div class="trip-route">{{ trip.from }} - {{ trip.to }}</div>
            <div class="trip-status">{{ trip.passengers }} passagers - {{ trip.status }}</div>
          </div>
        </div>
      </section>
      <section>
        <h2>Proposition de trajet</h2>
        <div v-for="trip in proposedTrips" :key="trip.id" class="trip-item" @click="goToProposedDetails(trip.id)">
          <div class="trip-date-time"><b>{{ trip.date }} à {{ trip.time }}</b></div>
          <div class="trip-details">
            <div class="trip-route">{{ trip.from }} - {{ trip.to }}</div>
            <div class="trip-status">{{ trip.passengers }} passagers - {{ trip.status }}</div>
          </div>
        </div>
      </section>
    </div>
</template>

<style scoped>
.bloc-vos-trajets {
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

section {
  margin-bottom: 20px;
}

.trip-item {
  background-color: #f0f0f0;
  border-radius: 10px;
  padding: 15px;
  margin-bottom: 10px;
  display: flex;
  flex-direction: column;
  cursor: pointer;
  transition: background-color 0.3s;
}

.trip-item:hover {
  background-color: #e2e2e2;
}

.trip-date-time {
  font-size: 1.1em;
  font-weight: bold;
  margin-bottom: 5px;
}

.trip-details {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.trip-route {
  flex-grow: 1; /* To make it take up remaining space */
}

.trip-person, .trip-status {
  font-size: 0.9em;
  color: #000000;
  margin-left: 10px; /* Adjust spacing */
}

.trip-status {
  color: green;  /* Ensures visibility of passenger status */
  font-weight: bold;
}
</style>
