<!-- Composant principal qui contient un élément vue-router, qui contient l'élément de la route chargé  -->

<script setup>
    import { ref, provide } from 'vue'
    import Message from './Pages/Message.vue' // Composant pour les messages généraux

    /**
     * Gère ce qui affiché dans le composant Message.vue
     *
     * @param message , message affiché
     * @param type , intitulé du message
     */
    const AfficherMessage = (message, type) => {
    showMessage.value = true;
    messageText.value = message;
    messageType.value = type;

    setTimeout(() => {
        showMessage.value = false;
    }, 3000);
    }

    // Constantes du Message.vue
    const showMessage = ref(false);
    const messageText = ref('');
    const messageType = ref('');

    provide('afficherMessageFunc', AfficherMessage); // Rend accessible la fonction à toutes les interfaces du router-view
</script>

<template>
    <div class="app-container">
        <div class="background"></div>

        <router-view ></router-view><!-- C'est ici que les différents .vue sont chargés -->

        <Message v-if="showMessage" :message="messageText" :type="messageType" />
    </div>

</template>

<style scoped>
    .app-container {
    position: relative;
    }

    .app-container > p, .app-container > h1, .app-container > h2, .app-container > h3 {
        font-size: medium;
    }

    .background {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: grey;
    z-index: -1;
    }
    body {
        background-color: aquamarine;
    }

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
