<!-- Représente l'interface de connexion  -->

<script setup>
    import { ref } from 'vue'
    import { useRouter } from 'vue-router'
    import { inject } from 'vue'
    import axios from 'axios';

    const identifiant = ref('')
    const motdepasse = ref('')

    const afficherMessageFunc = inject('afficherMessageFunc'); // Fonction qui gère l'affichage de messages généraux sur App_Connexion.vue

    /**
     * Gère la connexion à partir des identifiants / mot de passe renseignés
     */
    const connexion = () => {
    // On appelle le controller de connexion
    axios.post('/login', {
            Mail: identifiant.value,
            Mot_De_Passe: motdepasse.value,
        })
        .then(response => {
            // Tout c'est bien passé, on est emmené sur l'application
            console.log(response);
            window.location.href = '/app';
        })
        .catch(error => {
            // Une erreur est survenue
            if (error.response.status === 422) { // Erreur 422 = erreurs dans les identifiants / mot de passe
            afficherMessageFunc("Email ou mot de passe incorrect.", "Erreur");
            } else {
            afficherMessageFunc("Une erreur s'est produite lors de la tentative de connexion.", "Erreur");
            }
        });
    }

    const router = useRouter() // Récupération du router vue-router pour la navigation

    /**
     * Emmène sur l'interface de connexion
     */
    const inscription = () => {
    router.push({
        path: '/inscription-page1',
        query: {
            mail: "",
            nid: ""
        }

    });
    }

    /**
     * Emmène sur l'interface de mot de passe oublié
     */
    const motdepasseoublie = () => {
    router.push({
        path: '/mot-de-passe-oublie'

    });
    }
</script>

<template>
  <div class="bloc-principal">
    <h1>Connexion</h1>
    <div class="bloc-label">
      <div class="icone-mail" id="icone"></div>
      <input type="text" class="label" v-model="identifiant" placeholder="Mail ou NID" />
    </div>
    <div class="bloc-label">
      <div class="icone-cadenas" id="icone"></div>
      <input type="password" class="label" id="motdepasse" v-model="motdepasse" placeholder="Mot de Passe" />
    </div>
    <div class="boutons">
          <div class="connexion"
        @click="connexion"><p class="intitule-connexion">Connexion</p></div>
        <div class="inscription"
        @click="inscription"><p class="intitule-inscription">S'inscrire</p></div>
        </div>
    <p @click="motdepasseoublie" class="lien-mot-de-passe-oublie">Mot de passe oublié ?</p>
  </div>
</template>

<style scoped>
    .bloc-label {
        display: flex;
        flex-direction: row;
        height : 50px;
        width: 75%;
        margin-left : 12.5%;
        justify-content: space-between;
        margin-bottom : 10px;
    }

    input {
        width : 90%;
        font-size: medium;
        border : none;
        border-bottom: 1px solid #dddddd;
    }

    #icone {
        background-size: 30px 30px;
        background-repeat: no-repeat;
        background-position: center;
        width: 50px;
        height: 50px;
    }

    .icone-mail {
        background: url('assets/icons/connexion-arobase.png');
    }

    .icone-cadenas {
        background: url('assets/icons/connexion-cadenas.png');
    }

    h1 {
        margin-bottom : 100px;
    }

    p, h1 {
        text-align: center;
        border-top: 5px;
        color: black;
    }

    .boutons {
        display: flex;
        margin-left : 10%;
        margin-top : 20px;
        justify-content: space-between;
    }

    .connexion, .inscription {
        background-color: #bbbbbb;
        width: 120px;
        height: 35px;
        margin: auto;
        border-radius: 10px;
    }

    .lien-mot-de-passe-oublie {
        border-top: auto;
        justify-content: right;
    }
</style>


