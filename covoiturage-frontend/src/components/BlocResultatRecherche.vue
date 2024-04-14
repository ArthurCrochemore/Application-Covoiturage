<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import ResultatRecherche from './ResultatRecherche.vue'

const props = defineProps({
  ptDepart: String,
  ptArrive: String,
  typeTrajet: String,
  directionTrajet: String,
  heure: String,
  resultats: Array
})

const router = useRouter()
const retour = () => {
  router.push({
    path: '/'

  });
}

function alerte() {
    window.open('https://javascript.info');
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
        <h1>{{ ptDepart }} => {{ ptArrive }}</h1>
        <h1>{{ typeTrajet }} - {{ directionTrajet }} {{ heure }}</h1>
    </div>
    <div class="bloc-resultats-recherche">
      <ResultatRecherche
            v-for="(resultat, index) in JSON.parse(resultats)"
            :key="index"
            :ptDepart="resultat.ptDepart"
            :ptArrive="resultat.ptArrive"
            :typeTrajet="resultat.typeTrajet"
            :heure="resultat.heure"
            :nomConducteur="resultat.nomConducteur"
            :uniteConducteur="resultat.uniteConducteur"
        />
        <div class="alerte"
      @click="alerte()"><h1>Créer une alerte</h1></div>
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
}

.bloc-resultats-recherche {
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

.bloc-resultat {
    margin : 5px 10%;
    width : 80%;
    height: 90px;
}

.alerte {
    background-color: #73c57b;
    border-radius: 30px;
    width : 80%;
    height: 60px;
    margin : 5px 10%;
}

.alerte > h1{
    text-align: center;
    color : white;
    margin : auto;
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
    .bloc-resultats-recherche {
        bottom: 80px;
        top: 80px;
    }
}

@media (max-width : 1300px) {
    .bloc-resultats-recherche {
        width: 70%;
        left: 15%;
    }
}

@media (max-width : 900px) {
    .bloc-resultats-recherche {
        width: 80%;
        left: 10%;
    }
}

@media (max-width : 800px) {
    .bloc-resultats-recherche {
        width: 85%;
        left: 7.5%;
    }
}

@media (max-width : 700px) {
    .bloc-resultats-recherche {
        width: 90%;
        left: 5%;
    }
    .entete > h1 {
        font-size: 20px;
        margin: auto 0;
    }
}

@media (max-width : 600px) {
    .bloc-resultats-recherche {
        width: 96%;
        left: 2%;
    }
}

</style>
