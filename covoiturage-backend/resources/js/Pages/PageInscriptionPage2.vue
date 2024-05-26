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

const mail = ref(props.mail)
const nid = ref(props.nid)
const mdp = ref(props.mdp)

const afficherMessageFunc = inject('afficherMessageFunc');

const unite = ref('')
const numPoste = ref('')
const prenom = ref('')
const nomFamille = ref('')
const adressePostale = ref('')
const telephone = ref('')

const router = useRouter()
const continuer = () => {
  console.log("Unite:", unite.value)
  console.log("Num Poste:", numPoste.value)
  console.log("Prenom:", prenom.value)
  console.log("Nom:", nomFamille.value)
  console.log("Adresse:", adressePostale.value)
  console.log("Tel:", telephone.value)

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
        router.push({
            path: '/'

        });
      })
      .catch(error => {
        afficherMessageFunc(error, "Erreur");
        console.error(error);
      });
}

const annuler = () => {
  router.push({
    path: '/inscription-page1',
    query: {
        mail: mail.value,
        nid: nid.value
    }

  });
}

</script>

<template>
  <div class="bloc-connexion">
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
.bloc-connexion {
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
}

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
  flex-direction: row;
  height : 50px;
  width: 80%;
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

@media (max-height: 750px) {
    .entete {
        height: 60px;
    }
    .retour {
        background-size: 30px 30px;

    }
    .entete > h1 {
        font-size: medium;
        width : 100%;
        color : black;
        text-align: center;
    }
    .bloc-connexion {
        bottom: 80px;
        top: 80px;
    }
}

@media (max-width : 1300px) {
    .bloc-connexion {
        width: 70%;
        left: 15%;
    }
}

@media (max-width : 900px) {
    .bloc-connexion {
        width: 80%;
        left: 10%;
    }
}

@media (max-width : 800px) {
    .bloc-connexion {
        width: 85%;
        left: 7.5%;
    }
}

@media (max-width : 700px) {
    .bloc-connexion {
        width: 90%;
        left: 5%;
    }
}

@media (max-width : 600px) {
    .bloc-connexion {
        width: 96%;
        left: 2%;
    }
}
</style>


