<script setup>
import { ref, provide } from 'vue'
import BarreDeNavigation from './Pages/BarreDeNavigation.vue'
import Message from './Pages/Message.vue'


const AfficherMessage = (message, type) => {
  showMessage.value = true;
  messageText.value = message;
  messageType.value = type;

  setTimeout(() => {
    showMessage.value = false;
  }, 3000);
}

const showMessage = ref(false);
const messageText = ref('');
const messageType = ref('');

provide('afficherMessageFunc', AfficherMessage);
</script>

<template>
    <div class="main">
  <router-view ></router-view>
  <BarreDeNavigation />
  <Message v-if="showMessage" :message="messageText" :type="messageType" />
</div>

</template>


<style scoped>

header {
  line-height: 1.5;
}

.logo {
  display: block;
  margin: 0 auto 2rem;
}

.v-enter-active,
.v-leave-active {
  transition: opacity 0.5s ease;
}

.v-enter-from,
.v-leave-to {
  opacity: 0;
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
