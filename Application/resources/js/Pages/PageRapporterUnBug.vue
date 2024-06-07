<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { defineProps } from 'vue'

const props = defineProps({
  mail: String,
  unite: String,
  numPoste: String,
  prenom: String,
  nomFamille: String,
  adressePostale: String,
  telephone: String
})
const router = useRouter() // Récupération du router vue-router pour la navigation

const retour = () => {
  router.push({
    path: '/profil'

  });
  }

  const envoyer = () => {
  router.push({
    path: '/profil'
    // Valider l'envoi

  });
  retour();
  }

</script>

<template>
  <div class="entete">
        <div
      class="retour"
      style="
        background: url('assets/icons/fleche_retour.png');
        background-size: 60px 60px;
        background-repeat: no-repeat;
        background-position: center;
      "
      @click="retour()"
    ></div>
    <h1>Rapporter un bug</h1>
  </div>
  <div class="bloc-principal">
    <div class="bloc-texte">
      <textarea class="texte" cols="40" rows="5" v-model="message" :maxlength="250"></textarea>
    </div>
  <div class="boutons">
      <div class="envoyer"
          @click="envoyer"><p class="intitule-envoyer">Envoyer</p></div>
    </div>
  </div>
</template>

<style scoped>
.bloc-principal {
    top: 150px;
    bottom: 150px;
}

.entete > h1 {
    margin : auto;
}

.bloc-texte {
  flex: 1;
  margin: 30px 30px 50px 30px ;
  background-color: #bbbbbb;

}

.texte {
  width : 100%;
  height: 100%;
  border: none;
  resize: none;
  background-color: transparent;
  padding: 10px;
}

.boutons {
  display: flex;
  height : 50px;
  width: 80%;
  justify-content: right;
}

.envoyer {
  background-color: #bbbbbb;
  width: 120px;
  height: 35px;
  border-radius: 10px;
}

p{
  color : black;
  text-align: center;
  font-size: 20px;
}
</style>
