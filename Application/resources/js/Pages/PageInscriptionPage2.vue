<!-- Représente l'affichage de la seconde page d'inscription  -->

<script setup>
    import { ref } from 'vue'
    import { useRouter } from 'vue-router'
    import { inject } from 'vue'
    import axios from 'axios';

    const props = defineProps({
        mail: String,
        nid: String,
        mdp: String
    })

    /* Constante pour les données saisies */
    const mail = ref(props.mail)
    const nid = ref(props.nid)
    const mdp = ref(props.mdp)

    const unite = ref('')
    const numPoste = ref('')
    const prenom = ref('')
    const nomFamille = ref('')
    const adressePostale = ref('')
    const telephone = ref('')

    const afficherMessageFunc = inject('afficherMessageFunc'); // Fonction qui gère l'affichage de messages généraux sur App_Connexion.vue

    const routerV = useRouter() // Récupération du router vue-router pour la navigation

    /**
     * Inscription à partir des données saisies
     */
    const continuer = () => {
        axios.post('/utilisateur', {
                NID: nid.value,
                Nom: nomFamille.value,
                Prenom: prenom.value,
                Unite: unite.value,
                Numero_De_Poste: numPoste.value,
                Numero_De_Telephone: telephone.value,
                Mail: mail.value,
                Mot_De_Passe: mdp.value,
        })
        .then(response => {
            console.log(response);
            afficherMessageFunc("La demande d'inscription a été enregistrée avec succèes", "Succès");
            routerV.push({
                path: '/'

            });
        })
        .catch(error => {
            afficherMessageFunc(error, "Erreur");
            console.error(error);
        });
    }

    /**
     * Ramène vers la première page (y affiche les données mail et nid qui avaient été validées)
     */
    const annuler = () => {
        routerV.push({
            path: '/inscription-page1',
            query: {
                mail: mail.value,
                nid: nid.value
            }

        });
    }
</script>

<template>
  <div class="bloc-principal">
    <h1>Inscription</h1>
    <div class="bloc-label">
      <input type="text" class="label" v-model="unite" placeholder="Unité" />
    </div>
    <div class="bloc-label">
      <input type="text" class="label" v-model="numPoste" placeholder="N° de Poste" />
    </div>
    <div class="bloc-label">
      <input type="text" class="label" v-model="prenom" placeholder="Prénom" />
    </div>
    <div class="bloc-label">
      <input type="text" class="label" v-model="nomFamille" placeholder="Nom de Famille" />
    </div>
    <div class="bloc-label">
      <input type="text" class="label" v-model="adressePostale" placeholder="Adresse Postale" />
    </div>
    <div class="bloc-label">
      <input type="text" class="label" v-model="telephone" placeholder="Téléphone" />
    </div>
    <div class="boutons">
        <div class="annuler"
        @click="annuler"><p class="intitule-annuler">Annuler</p></div>
          <div class="continuer"
        @click="continuer"><p class="intitule-continuer">Continuer</p></div>
        </div>
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

    h1 {
        margin-bottom : 10px;
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

    .annuler, .continuer {
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


