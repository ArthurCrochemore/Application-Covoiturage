<script setup>
import { ref } from 'vue'

const typesDeTrajet = ref(['Trajet Base -> Domicile', 'Trajet Domicile -> Base'])
const indexTypeDeTrajetActif = ref(0)

const basculerTypeDeTrajet = () => {
  indexTypeDeTrajetActif.value = (indexTypeDeTrajetActif.value + 1) % typesDeTrajet.value.length
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
      <div class="bloc-date">
        <div class="icone-date"></div>
        <input type="text" class="date" placeholder="Date" />
      </div>
      <div class="bloc-heure">
        <div class="icone-heure"></div>
        <input type="text" class="heure" placeholder="Heure de départ" />
      </div>
    </div>
    <div class="trajet-regulier"><p class="intitule-trajet-regulier">Trajet Regulier</p></div>
    <div class="rechercher"><p class="intitule-rechercher">Rechercher</p></div>
  </div>
</template>

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
  background-size: 40px 40px;
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
  width: 50%;
  margin: auto 25%;
  height: auto;

  justify-content: space-between;
}

.heure,
.date {
  border: none;
  margin-left: 10px;
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

p {
  border-top: 5px;
  color: black;
}

.trajet-regulier {
  width: 90%;
  margin: auto 5%;
  text-align: center;
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
</style>
