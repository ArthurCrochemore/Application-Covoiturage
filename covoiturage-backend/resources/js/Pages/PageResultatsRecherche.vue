<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import BlocResultatRecherche from './BlocResultatRecherche.vue'

const props = defineProps({
  domicile: String,
  villeDomicile: String,
  base: String,
  villeBase: String,
  booleenTrajetBaseDomicile: Boolean,
  typeTrajet: String,
  heure: String,
  resultats: Array
})

const depart = ref(props.villeDomicile)
const arrive = ref(props.base)

var directionTrajet = ref("Départ")
if(props.booleenTrajetBaseDomicile) {
  directionTrajet = ref("Arrivé")
}

const router = useRouter()
const retour = () => {
  router.push({
    path: '/recherche',
  query: {
      domiciles: ["Rue de l'Allouette, Paris",
      "Rue de la Fortilière, St Avertin",
      "Rue Auguste Chevalier, Tours"],
      villeDomiciles : ["Paris",
        "St Avertin",
        "Tours"
      ],
      basesAeriennes: ["Base aerienne de Tours"],
      villeBases: ["Tours"],
      ptDepart: props.domicile.value,
      ptArrive: props.base.value
    }
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
        background: url('assets/icons/fleche_retour.png');
        background-size: 60px 60px;
        background-repeat: no-repeat;
        background-position: center;
      "
      @click="retour()"
    ></div>
        <h1> {{ depart }}  - {{ arrive }}</h1>
        <h1>{{ typeTrajet }} - {{ directionTrajet }} {{ heure }}</h1>
    </div>
    <div class="bloc-resultats-recherche">
      <BlocResultatRecherche
            v-for="(resultat, index) in JSON.parse(resultats)"
            :key="index"
            :idTrajet="resultat.idTrajet"
            :ptDepart="resultat.ptDepart"
            :ptArrive="resultat.ptArrive"
            :typeTrajet="resultat.typeTrajet"
            :heureDepart="resultat.heureDepart"
            :heureArrive="resultat.heureArrive"
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
  top: 100px;
  bottom: 100px;
  padding : 10px 0;
  left: 20%;
  display: flex;
  flex-direction: column;
  overflow-y: auto;
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

.alerte:hover {
    background-color: #7ccc84;
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
