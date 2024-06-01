<script setup>
import { ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios'

    const trajetsConducteur = ref()
    const trajetsPassager = ref()

    /**
     * Récupère tout les trajets dont l'utilisateur est conducteur
     */
     const recuperationTrajetsConducteurs = async () => {
        try {
            const response = await axios.get('/trajets-conducteur')
            trajetsConducteur.value = response.data
        } catch (error) {
            console.error('Error fetching trajets:', error)
        }
    }

    /**
     * Récupère tout les trajets dont l'utilisateur est passager
     */
     const recuperationTrajetsPassagers = async () => {
        try {
            const response = await axios.get('/trajets-passager')
            trajetsPassager.value = response.data
        } catch (error) {
            console.error('Error fetching trajets:', error)
        }
    }

    /**
     * Appellé au chargement de la page, récupère alors tout les trajets (TODO : faire une recherche à paramètres)
     */
     onMounted(() => {
        recuperationTrajetsConducteurs()
        recuperationTrajetsPassagers()
    })

const router = useRouter() // Récupération du router vue-router pour la navigation

function goToConductorDetails(idTrajet) {
    router.push({path: '/detail-trajet-conducteur',
    query: { idTrajet: idTrajet } });
}

function goToPassengerDetails(idTrajet) {
    router.push({path: '/detail-trajet-passager',
    query: { idTrajet: idTrajet } });
}

function goToProposedDetails(tripId) {
  router.push({path: '/detail-trajet-conducteur', params: { id: tripId } });
}


</script>

<template>
    <div class="bloc-principal">
      <section>
        <h2>Trajets Passagers</h2>
        <div v-for="trip in trajetsPassager " :key="trip.idTrajet" class="trip-item" @click="goToPassengerDetails(trip.idTrajet)">
          <div class="trip-date-time"><b>{{ trip.date }}, {{ trip.heure }}</b></div>
          <div class="trip-details">
            <div class="trip-route">{{ trip.ptDepart }} - {{ trip.ptArrive }}</div>
            <div class="trip-person">Avec {{ trip.nomConducteur }}</div>
          </div>
        </div>
      </section>
      <section>
        <h2>Trajets Conducteurs</h2>
        <div v-for="trip in trajetsConducteur" :key="trip.idTrajet" class="trip-item" @click="goToConductorDetails(trip.idTrajet)">
          <div class="trip-date-time"><b>{{ trip.date }}, {{ trip.heure }}</b> <div v-if="trip.nouvellesDemandes" class="cercle"></div></div>
          <div class="trip-details">
            <div class="trip-route">{{ trip.ptDepart }} - {{ trip.ptArrive }}</div>
            <div class="trip-status">{{ trip.nbPassagers }} / {{ trip.nbMaxPassagers }} Passagers - {{ trip.status }}</div>
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
    .bloc-principal {
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
</style>
