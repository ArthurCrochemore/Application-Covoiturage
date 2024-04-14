<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'

const typesDeTrajet = ref(['Trajet Base -> Domicile', 'Trajet Domicile -> Base'])
const heureDepartArrive = ref(['Heure de Départ', "Heure d'Arrivé"])
const indexTypeDeTrajetActif = ref(0)

const dateId = ref(['non-grise', 'grise'])
const indexBouttonSwitch = ref(0)
const estGrise = ref(false)

const basculerTypeDeTrajet = () => {
  indexTypeDeTrajetActif.value = (indexTypeDeTrajetActif.value + 1) % typesDeTrajet.value.length
}

const router = useRouter()

const changerIdGrise = () => {
  indexBouttonSwitch.value = (indexBouttonSwitch.value + 1) % dateId.value.length
  estGrise.value = !estGrise.value
}

const resultatsRecherche = () => {
  return [
    {
      ptDepart: "Paris",
      ptArrive: "Base Aérienne",
      typeTrajet: "Régulier",
      heureDepart: "",
      heureArrive: "10h45",
      nomConducteur: "John",
      uniteConducteur: "67890"
    },
    {
      ptDepart: "St Avertin",
      ptArrive: "Base Aérienne",
      typeTrajet: "Régulier",
      heureDepart: "",
      heureArrive: "10h50",
      nomConducteur: "Marie",
      uniteConducteur: "9076908769"
    },
    {
      ptDepart: "Paris",
      ptArrive: "Base Aérienne",
      typeTrajet: "Régulier",
      heureDepart: "",
      heureArrive: "10h45",
      nomConducteur: "John",
      uniteConducteur: "67890"
    },
    {
      ptDepart: "Paris",
      ptArrive: "Base Aérienne",
      typeTrajet: "Régulier",
      heureDepart: "",
      heureArrive: "10h45",
      nomConducteur: "John",
      uniteConducteur: "67890"
    },
    {
      ptDepart: "Paris",
      ptArrive: "Base Aérienne",
      typeTrajet: "Régulier",
      heureDepart: "",
      heureArrive: "10h45",
      nomConducteur: "John",
      uniteConducteur: "67890"
    },
    {
      ptDepart: "Paris",
      ptArrive: "Base Aérienne",
      typeTrajet: "Régulier",
      heureDepart: "",
      heureArrive: "10h45",
      nomConducteur: "John",
      uniteConducteur: "67890"
    },
    {
      ptDepart: "Paris",
      ptArrive: "Base Aérienne",
      typeTrajet: "Régulier",
      heureDepart: "",
      heureArrive: "10h45",
      nomConducteur: "John",
      uniteConducteur: "67890"
    },
    {
      ptDepart: "Paris",
      ptArrive: "Base Aérienne",
      typeTrajet: "Régulier",
      heureDepart: "",
      heureArrive: "10h45",
      nomConducteur: "John",
      uniteConducteur: "67890"
    },
    {
      ptDepart: "Paris",
      ptArrive: "Base Aérienne",
      typeTrajet: "Régulier",
      heureDepart: "",
      heureArrive: "10h45",
      nomConducteur: "John",
      uniteConducteur: "67890"
    },
    {
      ptDepart: "Paris",
      ptArrive: "Base Aérienne",
      typeTrajet: "Régulier",
      heureDepart: "",
      heureArrive: "10h45",
      nomConducteur: "John",
      uniteConducteur: "67890"
    }
  ];
}

const recherche = () => {
  router.push({
    path: '/resultat-recherche',
    query: {
      ptDepart: 'St Avertin',
      ptArrive: 'Base Aerienne',
      typeTrajet: 'Regulier',
      heure: '10h50',
      directionTrajet: 'Arrivé',
      resultats : JSON.stringify(resultatsRecherche())
    }
  });
}
</script>

<template>
  <div class="bloc-de-recherche">
    <div class="type-de-trajet" @click="basculerTypeDeTrajet">
      <h1 class="intitule-type-de-trajet">{{ typesDeTrajet[indexTypeDeTrajetActif] }}</h1>
    </div>
    <div class="bloc-label-depart-arrive">
      <div class="icone-map"></div>
      <input type="text" class="label" id="depart-label" placeholder="Départ" />
    </div>
    <div class="bloc-label-depart-arrive">
      <div class="icone-map"></div>
      <input type="text" class="label" id="arrive-label" placeholder="Arrivé" />
    </div>
    <div class="date-et-heure">
      <div class="bloc-date" :id="dateId[indexBouttonSwitch]">
        <div class="icone-date"></div>
        <input type="date" v-model="date" :disabled="estGrise">
      </div>
      <div class="bloc-heure">
        <div class="icone-heure"></div>
        <input type="time" v-model="heure">
      </div>
    </div>
    <div class="trajet-regulier">
      <div class="switch-container">
          <input type="checkbox" id="switch1" v-model="trajetRegulier" class="input-checkbox" @change="changerIdGrise">
          <label for="switch1" class="switch-label"></label>
      </div>
      <p class="intitule-trajet-regulier">Trajet Regulier</p>
    </div>
    <div class="rechercher"
        @click="recherche"><p class="intitule-rechercher">Rechercher</p></div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      timeValue: '8:00'
    }
  }
}
</script>

<style scoped>
.bloc-de-recherche {
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

.type-de-trajet {
  background-color: #dddddd;
  width: 90%;
  height: 80px;
  margin: auto 5%;
  border-radius: 30px;
}

.intitule-type-de-trajet {
  color: black;
  text-align: center;
  font-size: 30px;
  margin-top: 12px;
}

.bloc-label-depart-arrive {
  display: flex;
  flex-direction: row;
  height : 50px;
  width: 75%;
  margin-left : 12.5%;
  justify-content: space-between;
}

.icone-map {
  background: url('src/assets/icons/navigation-map-marker.png');
  background-size: 30px 30px;
  background-repeat: no-repeat;
  background-position: center;
  width: 50px;
  height: 50px;
}

.label {
  border: none;
  border-bottom: 1px solid #dddddd;
  height: 50px;
  width: 100%;
}

.date-et-heure {
  display: flex;
  flex-direction: row;
  width: 65%;
  margin-top : 30px;
  margin-left: 17.5%;
  height: 50px;

  justify-content: space-between;
}

.bloc-date,
.bloc-heure {
  display: flex;
  flex-direction: row;
}

input[type="date"],
input[type="time"] {
    width: 100%;
    height : 40px;
    float: right;
    color: black;
    border: 1px solid black;
    border-radius: 30px;
    padding-left: 10px;
    padding-right: 10px;
}

input[type="time"] {
    clear: both;
}

.icone-date {
  background: url('src/assets/icons/recherche-calendrier.png');
  background-size: 30px 30px;
  background-repeat: no-repeat;
  background-position: center;
  width: 50px;
  height: 50px;
  padding-right: 50px;
  padding-bottom: 10px;
}

.icone-heure {
  background: url('src/assets/icons/recherche-horloge.png');
  background-size: 30px 30px;
  background-repeat: no-repeat;
  background-position: center;
  width: 50px;
  height: 50px;
  padding-right: 50px;
  padding-bottom: 10px;
}

.input-checkbox {
    display: none;
}

.switch-label {
    display: block;
    width: 50px;
    height: 30px;
    background-color: #ccc;
    border-radius: 20px;
    position: relative;
    cursor: pointer;
    margin-right: 5px;
}

.input-checkbox:checked+.switch-label {
    background-color: #007bff;
}

.switch-label::after {
    content: "";
    position: absolute;
    top: 4px;
    left: 4px;
    width: 22px;
    height: 22px;
    background-color: white;
    border-radius: 50%;
    transition: transform 0.3s;
}

.input-checkbox:checked+.switch-label::after {
    transform: translateX(20px);
}

#grise {
  filter: opacity(50%);
  transition: filter 0.5s ease;
}

#non-grise {
  filter: opacity(100%);
  transition: filter 0.5s ease;
}

p {
  border-top: 5px;
  color: black;
}

.trajet-regulier {
  display: flex;
  flex-direction: row;
  height: 50px;
  width: 190px;
  margin: auto;
  text-align: center;
  height: auto;

  justify-content: space-between;
}

.rechercher {
  background-color: #bbbbbb;
  width: 120px;
  height: 40px;
  margin: auto;
  border-radius: 10px;
}

.intitule-rechercher {
  padding-top: 3px;
  text-align: center;
}

p,
input {
  font-size: 20px;
}

v-digital-time-picker {
  width: 100px;
  height: 100px;
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
    .bloc-de-recherche {
        bottom: 80px;
        top: 80px;
    }
}

@media (max-width : 1300px) {
    .bloc-de-recherche {
        width: 70%;
        left: 15%;
    }
}

@media (max-width : 900px) {
    .bloc-de-recherche {
        width: 80%;
        left: 10%;
    }
}

@media (max-width : 800px) {
    .bloc-de-recherche {
        width: 85%;
        left: 7.5%;
    }
}

@media (max-width : 700px) {
    .bloc-de-recherche {
        width: 90%;
        left: 5%;
    }
}

@media (max-width : 600px) {
    .bloc-de-recherche {
        width: 96%;
        left: 2%;
    }
}
</style>


