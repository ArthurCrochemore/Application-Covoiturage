<script setup>
import { ref } from 'vue'
import BarreDeNavigation from './components/BarreDeNavigation.vue'
import Message from './components/Message.vue'

const AfficherMessage = (message, type, couleur) => {
  showMessage.value = true;
  messageText.value = message;
  messageType.value = type;
  messageCouleur.value = couleur;
  setTimeout(() => {
    showMessage.value = false;
  }, 3000);
}


const showMessage = ref(false);
const messageText = ref('');
const messageType = ref('');
const messageCouleur = ref('');
</script>

<template>
  <router-view ></router-view>
  <BarreDeNavigation />
  <Message v-if="showMessage" :message="messageText" :type="messageType" :couleur="messageCouleur" />

</template>

<script>
export default {
  methods: {
    afficherMessage(message, type, couleur) {
      this.AfficherMessage(message, type, couleur);
    }
  }
}
</script>

<style scoped>
header {
  line-height: 1.5;
}

.logo {
  display: block;
  margin: 0 auto 2rem;
}

#message {
  background-color: var(--messageCouleur);
  visibility: hidden;
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
