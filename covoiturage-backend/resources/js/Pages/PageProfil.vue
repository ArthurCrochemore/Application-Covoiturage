<!-- Représente l'interface Profil  -->

<script setup>
  import { ref, onMounted } from 'vue'
  import { useRouter } from 'vue-router'
  import { inject } from 'vue'
  import axios from 'axios';

  const afficherMessageFunc = inject('afficherMessageFunc'); // Fonction qui gère l'affichage de messages généraux sur App.vue

  /* Constantes pour l'affichage des données du profil, TODO : charger depuis la bdd */

  const profil = ref({
  prenom: '',
  nom: '',
  unite: '',
  adresse: '',
  mail: '',
  telephone: ''
})

  const fetchProfil = async () => {
    try {
      const response = await axios.get('/profil');
    const profilData = response.data['']; // Accès aux données du profil à partir de la clé vide
    profil.value = profilData;
    
    } catch (error) {
      console.error('Erreur lors de la récupération du profil :', error);
    }
  }

  onMounted(fetchProfil);

  const router = useRouter() // Récupération du router vue-router pour la navigation

  /**
   * Amène l'interface de modification des données du profil
   */
  const modifier = () => {
    router.push({
        path: '/modification-profil',
        query: {
            prenom: profil.value.Prenom,
            nomFamille: profil.value.Nom,
            unite: profil.value.Unite,
            adressePostale: profil.value.AdressePostale,
            mail: profil.value.Mail,
            telephone: profil.value.Numero_De_Telephone,
            numPoste: profil.value.Numero_De_Poste
        }
    });
  }

  /**
   * Déconnecte l'utilisateur actuel
   */
  const deconnexion = () => {
    axios.post('/logout', {
      })
      .then(response => {
        // Déconnexion réussie
        console.log(response);
        afficherMessageFunc("Déconnexion réussie", "Succès");
        window.location.href = '/';
      })
        // Erreur lors de la déconnexion
      .catch(error => {
        afficherMessageFunc(error.message, "Erreur");
        console.error(error);
      });
  }

  /**
   * Ouvre l'interface de rapport de bug
   */
  const rapportBug = () => {
        router.push({
        path: '/rapport-bug'
    });
  }

</script>

<template>
    <div class="bloc-principal">
      <div class="bloc-identite">
        <div class="identite">
          <h3 class="prenom">Prénom : {{ profil.Prenom }}</h3>
          <h3 class="nom">Nom : {{ profil.Nom }}</h3>
          <h3 class="unite">Unité : {{ profil.Unite }}</h3>
        </div>
      </div>
        <div class="bloc-informations">
          <div class="informations">
            <div class="informations-adresse">
              <div class="icone-adresse"></div>
              <h3 class="adresse">{{ profil.AdressePostale }}</h3>
            </div>
            <div class="informations-mail">
              <div class="icone-mail"></div>
              <h3 class="mail">{{ profil.Mail }}</h3>
            </div>
            <div class="informations-telephone">
              <div class="icone-telephone"></div>
              <h3 class="telephone">{{ profil.Numero_De_Telephone }}</h3>
            </div>
          </div>
        </div>
        <div class="boutons">
          <div class="modifier"
        @click="modifier"><p class="intitule-modifer">Modifier</p></div>
        <div class="deconnexion"
        @click="deconnexion"><p class="intitule-deconnexion">Déconnexion</p></div>
        </div>
        <div class="bouton-rapport-bug">
          <div class="rapport-bug"
        @click="rapportBug"><p class="intitule-rapport-bug">Rapporter un bug</p></div>
        </div>
      </div>
</template>

<style scoped>
    .bloc-identite {
        margin-top: 5%;
        width : 100%;
        height: 30%;
    }

    .identite {
        margin-left : 10%;
    }

    h3 {
        font-size: 20px;
        margin-top: 5px;
        color: black;
    }
    .bloc-informations {
        display: flex;
        flex-direction: column;
        width : 100%;
        height: 40%;
    }

    .informations-adresse, .informations-mail, .informations-telephone {
        display: flex;
        flex-direction: row;
        height : 50px;
        width: 350px;
        margin-left : 12.5%;
        justify-content: flex-start;
    }

    .icone-adresse {
        background: url('assets/icons/navigation-map-marker.png');
        background-size: 30px 30px;
        background-repeat: no-repeat;
        background-position: center;
        width: 50px;
        height: 50px;
        margin-left: 5%;
    }

    .icone-mail {
        background: url('assets/icons/profil-mail.png');
        background-size: 30px 30px;
        background-repeat: no-repeat;
        background-position: center;
        width: 50px;
        height: 50px;
        margin-left: 5%;
    }

    .icone-telephone {
        background: url('assets/icons/profil-telephone.png');
        background-size: 30px 30px;
        background-repeat: no-repeat;
        background-position: center;
        width: 50px;
        height: 50px;
        margin-left: 5%;
    }

    .boutons, .bouton-rapport-bug {
        display: flex;
        justify-content: space-between;
        width: 100%;
    }

    .modifier, .deconnexion, .rapport-bug {
        background-color: #bbbbbb;
        width: 120px;
        height: 35px;
        margin: auto;
        border-radius: 10px;
    }

    .deconnexion {
        background-color: #e33333;
    }

    .bouton-rapport-bug {
        border-top: auto;
        justify-content: right;
    }

    .rapport-bug {
        width : 300px;
    }

    p{
        color : black;
        text-align: center;
        font-size: 20px;
    }
</style>
