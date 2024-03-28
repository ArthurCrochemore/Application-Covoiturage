<script setup>
import { ref } from 'vue'
import PopupDatePicker from './PopupDatePicker.vue'; // Assurez-vous que le chemin d'importation est correct

const typesDeTrajet = ref(['Trajet Base -> Domicile', 'Trajet Domicile -> Base'])
const heureDepartArrive = ref(['Heure de Départ', "Heure d'Arrivé"])
const indexTypeDeTrajetActif = ref(0)

const bouttonSwitch = ref([
  'src/assets/icons/boutton-switch-off.png',
  'src/assets/icons/boutton-switch-on.png'
])
const dateId = ref(['non-grise', 'grise'])
const indexBouttonSwitch = ref(0)

const basculerTypeDeTrajet = () => {
  indexTypeDeTrajetActif.value = (indexTypeDeTrajetActif.value + 1) % typesDeTrajet.value.length
}

const activerDesactiverBouttonSwitch = () => {
  indexBouttonSwitch.value = (indexBouttonSwitch.value + 1) % bouttonSwitch.value.length
}

const ouvrirDatePicker = () => {
  document.getElementsByClassName("date").innerText = date;
}

const selectedDate = ref(null)
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
        <p class="date">Date</p>
     </div>
      <div class="bloc-heure">
        <div class="icone-heure"></div>
        <p class="heure">{{ heureDepartArrive[indexTypeDeTrajetActif] }}</p>
      </div>
    </div>
    <div class="trajet-regulier">
      <div
        class="icone-boutton-switch"
        @click="activerDesactiverBouttonSwitch"
        :style="{
          backgroundImage: 'url(' + (bouttonSwitch[indexBouttonSwitch] || '') + ')',
          backgroundSize: '50px 50px',
          backgroundRepeat: 'no-repeat',
          backgroundPosition: 'center',
          width: '50px',
          height: '50px'
        }"
      ></div>
      <p class="intitule-trajet-regulier">Trajet Regulier</p>
    </div>
    <div class="rechercher"><p class="intitule-rechercher">Rechercher</p></div>
  <PopupDatePicker></PopupDatePicker>
  </div>

</template>

<script>
export default {
  data() {
    return {
      date : new Date()
    }
  }
}
</script>

<style scoped>
.bloc-de-recherche {
  width: 60%;
  height: auto;
  position: fixed;
  top: 100px;
  bottom: 200px;
  left: 20%;
  display: flex;
  flex-direction: column;
  background-color: white;
  border-radius: 30px;
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
}

.icone-map {
  background: url('src/assets/icons/navigation-map-marker.png');
  background-size: 30px 30px;
  background-repeat: no-repeat;
  background-position: center;
  width: 50px;
  height: 50px;
  margin-left: 5%;
}

.label {
  border: none;
  border-bottom: 1px solid #dddddd;
  width: 75%;
  height: 40px;
  margin: auto 10% auto 3%;
}

.date-et-heure {
  display: flex;
  flex-direction: row;
  width: 100%;
  margin: auto;
  height: auto;

  justify-content: space-between;
}

.bloc-date {
  padding-left: 20%;
}

.bloc-heure {
  padding-right: 20%;
}

.heure,
.date {
  border-top: 5px;
}

.bloc-date,
.bloc-heure {
  display: flex;
  flex-direction: row;
}

.icone-date {
  background: url('src/assets/icons/recherche-calendrier.png');
  background-size: 30px 30px;
  background-repeat: no-repeat;
  background-position: center;
  width: 50px;
  height: 50px;
}

.icone-heure {
  background: url('src/assets/icons/recherche-horloge.png');
  background-size: 30px 30px;
  background-repeat: no-repeat;
  background-position: center;
  width: 50px;
  height: 50px;
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
  width: 180px;
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

@media only screen and (max-width: 945px) {
  .bloc-date {
    padding-left: 10%;
  }
  .bloc-heure {
    padding-right: 10%;
  }
}

@media only screen and (max-width: 600px) {
  .bloc-date {
    padding-left: 10px;
  }
  .bloc-heure {
    padding-right: 10px;
  }
}

v-date-picker {
  position: relative;
  z-index: -1;
}
</style>
