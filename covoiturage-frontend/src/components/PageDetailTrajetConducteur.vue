<template>
    <div class="trip-details">
      <button class="back-button" @click="goBack">&#8678; Back</button>
      <h1>Trip Details</h1>
      <div class="trip-info">
        <p><span class="label">ID:</span> {{ trip.id }}</p>
        <p><span class="label">Date:</span> {{ trip.date }}</p>
        <p><span class="label">Time:</span> {{ trip.time }}</p>
        <p><span class="label">From:</span> {{ trip.from }} <span class="label">to</span> {{ trip.to }}</p>
      </div>
    </div>
  </template>
  
  <script setup>
  import { onMounted, ref } from 'vue';
  import { useRoute } from 'vue-router';
  import { useRouter } from 'vue-router';
  
  const trip = ref({});
  const route = useRoute();
  const router = useRouter();
  
  onMounted(() => {
    fetchTripDetails();
  });
  
  function fetchTripDetails() {
    const tripId = route.params.id;
    // Exemple
    trip.value = { id: tripId, date: '2024-01-16', time: '08:00', from: 'Paris', to: 'Lyon' };
  }

  function goBack() {
  router.back();
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
    margin-bottom: 2rem;
    color: #222;
  }
  
  .trip-info {
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 360px;
  }
  
  .label {
    font-weight: bold;
    color: #555;
  }
  
  p {
    font-size: 1rem;
    line-height: 1.5;
    margin-bottom: 0.5rem;
  }
  </style>
  