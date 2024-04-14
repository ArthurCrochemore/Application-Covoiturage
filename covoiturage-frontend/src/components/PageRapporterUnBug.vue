<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'

const props = defineProps({
  mail: String,
  unite: String,
  numPoste: String,
  prenom: String,
  nomFamille: String,
  adressePostale: String,
  telephone: String
})

const router = useRouter()

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
        background: url('src/assets/icons/fleche_retour.png');
        background-size: 60px 60px;
        background-repeat: no-repeat;
        background-position: center;
      "
      @click="retour()"
    ></div>
    <h1>Rapporter un bug</h1>
  </div>
  <div class="bloc-rapporter-bug">
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
.entete {
    width: 100%;
    height: 100px;
  background-color: white;
  position: fixed;
  top: 0;
  left: 0;
  display: flex;
  flex-direction: column;
}

.retour {
    width : 60px;
    height: 60px;
    top : 20px;
    left : 20px;
    position : absolute;
}

.entete > h1 {
    width : 100%;
    color : black;
    text-align: center;
    margin : auto;
}

.bloc-rapporter-bug {
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
  flex-direction: row;
  height : 50px;
  width: 80%;
  justify-content: right;
  margin-top: auto;
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
    .bloc-rapporter-bug {
        bottom: 80px;
        top: 80px;
    }
}

@media (max-width : 1300px) {
    .bloc-rapporter-bug {
        width: 70%;
        left: 15%;
    }
}

@media (max-width : 900px) {
    .bloc-rapporter-bug {
        width: 80%;
        left: 10%;
    }
}

@media (max-width : 800px) {
    .bloc-rapporter-bug {
        width: 85%;
        left: 7.5%;
    }
}

@media (max-width : 700px) {
    .bloc-rapporter-bug {
        width: 90%;
        left: 5%;
    }
    .entete > h1 {
        font-size: 20px;
        margin: auto 0;
    }
}

@media (max-width : 600px) {
    .bloc-rapporter-bug {
        width: 96%;
        left: 2%;
    }
}
</style>
