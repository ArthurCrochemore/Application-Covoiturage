<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'

import axios from 'axios';
const router = useRouter() // Récupération du router vue-router pour la navigation

const trajetRegulier = ref(false)
const bagage = ref('Beaucoup')
const nombrePassagers = ref(0)
const description = ref('')
const date = ref('')
const heure = ref('')

const dateId = ref(['non-grise', 'grise'])
const indexBouttonSwitch = ref(0)
const estGrise = ref(false)

const changerIdGrise = () => {
    indexBouttonSwitch.value = (indexBouttonSwitch.value + 1) % dateId.value.length
    estGrise.value = !estGrise.value
}

const inversionDepartArrivee = () => {
    const depart = document.getElementById('depart-label').value;
    const arrive = document.getElementById('arrive-label').value;
    document.getElementById('depart-label').value = arrive;
    document.getElementById('arrive-label').value = depart;
}

const creerTrajet = () => {
    // Création d'un objet contenant les données du trajet à envoyer
    const trajetData = {
        DateDepart: date.value,
        HeureDepart: heure.value,
        NbrePlaces: nombrePassagers.value,
        QteBagages: bagage.value,
        Description: description.value,
        TrajetRegulier: trajetRegulier.value,
        Statut: 0,
        DomicileBase: false, 
        IdDomicile: 1, 
        IdBase: 1, 
        IdJours: [0,0,0,0,0,0,0], 
        IdConducteur: 1,
    };

    axios.post('/api/trajets', trajetData)
    .then(() => router.push('/creation-suivant'))
    .catch(() => alert('Une erreur est survenue lors de la création du trajet'));
}

</script>

<template>
    <div class="bloc-de-creation">
        <div class="titre-bloc">
            <h1 class="intitule-creation">Création d'un trajet</h1>
        </div>
        <div class="bloc-label-depart-arrive">
            <div class="icone-map"></div>
            <input type="text" class="label" id="depart-label" placeholder="Départ" />
        </div>
        <div class="icone-arrows" @click="inversionDepartArrivee">
        </div>
        <div class="bloc-label-depart-arrive">
            <div class="icone-map"></div>
            <input type="text" class="label" id="arrive-label" placeholder="Arrivé" />
        </div>
        <div class="date-et-heure">
            <div class="trajet-regulier">
                <div class="switch-container">
                    <input type="checkbox" id="switch1" v-model="trajetRegulier" class="input-checkbox"
                        @change="changerIdGrise">
                    <label for="switch1" class="switch-label"></label>
                </div>
                <p class="intitule-trajet-regulier">Trajet Regulier</p>
            </div>

        </div>

        <div class="date-et-heure">
            <div class="bloc-date" :id="dateId[indexBouttonSwitch]">
                <input type="date" v-model="date" :disabled="estGrise">
            </div>
            <div class="bloc-heure">
                <input type="time" v-model="heure">
            </div>
        </div>
        <div v-if="trajetRegulier" class="switch-container" id="switchregulier">
            <input type="checkbox" id="lundi" class="checkbox-input" value="1">
            <label for="lundi" class="checkbox-label2">Lundi</label>
            <input type="checkbox" id="mardi" class="checkbox-input" value="1">
            <label for="mardi" class="checkbox-label2">Mardi</label>
            <input type="checkbox" id="mercredi" class="checkbox-input" value="1">
            <label for="mercredi" class="checkbox-label2">Mercredi</label>
            <input type="checkbox" id="jeudi" class="checkbox-input" value="1">
            <label for="jeudi" class="checkbox-label2">Jeudi</label>
            <input type="checkbox" id="vendredi" class="checkbox-input" value="1">
            <label for="vendredi" class="checkbox-label2">Vendredi</label>
            <input type="checkbox" id="samedi" class="checkbox-input" value="1">
            <label for="samedi" class="checkbox-label2">Samedi</label>
            <input type="checkbox" id="dimanche" class="checkbox-input" value="1">
            <label for="dimanche" class="checkbox-label2">Dimanche</label>
        </div>

        <div class="bagage">
            <select class="select-bagage" v-model="bagage">
                <option value="1">Beaucoup</option>
                <option value="2">Moyen</option>
                <option value="3">Peu</option>
            </select>
            <label class="checkbox-label">Bagages</label>
        </div>

        <div class="passagers">
            <input class="input-passagers" type="number" v-model="nombrePassagers">
            <label class="checkbox-label">Passagers</label>
        </div>
        <div class="description-area">
            <label class="checkbox-label">Description:</label>
            <textarea class="text-area" v-model="description"></textarea>
        </div>
        <div class="suivant" @click="creerTrajet">
            <p class="intitule-suivant">Suivant</p>
        </div>
    </div>
</template>


<style scoped>

.bloc-de-creation {
    width: 60%;
    height: auto;
    position: fixed;
    top: 50px;
    bottom: 150px;
    left: 20%;
    display: flex;
    flex-direction: column;
    background-color: white;
    border-radius: 40px;
}

.titre-bloc {
    background-color: #dddddd;
    width: 90%;
    height: 80px;
    margin: auto 5%;
    border-radius: 30px;
}

.intitule-creation {
    color: black;
    text-align: center;
    font-size: 30px;
    margin-top: 12px;
}

.bloc-label-depart-arrive {
    display: flex;
    flex-direction: row;
    height: 50px;
    width: 75%;
    margin-left: 12.5%;
    justify-content: space-between;
}

.icone-map {
    background: url('assets/icons/navigation-map-marker.png');
    background-size: 30px 30px;
    background-repeat: no-repeat;
    background-position: center;
    width: 50px;
    height: 50px;
}

.icone-arrows {
    background: url('assets/icons/fleches-bidirection.png');
    background-size: 30px 30px;
    background-repeat: no-repeat;
    background-position: center;
    width: 50px;
    height: 50px;
    margin-left: 20%;
}
button {
    background-color: transparent;
    border: none;
    cursor: pointer;
}

.label {
    border: none;
    border-bottom: 1px solid #dddddd;
    height: 50px;
    width: 100%;
}

.bagage {
    display: flex;
    flex-direction: row;
    width: 80%;
    margin-left: 10%;
    height: 50px;
    justify-content: space-between;
    align-items: center;
}

.passagers {
    display: flex;
    flex-direction: row;
    width: 80%;
    margin-left: 10%;
    height: 50px;
    justify-content: space-between;
    align-items: center;
}

input[type="number"] {
    width: 20%;
    padding: 5px;
    margin-top: 5px;
    border: none;
    border-bottom: 1px solid black;
    outline: none;
    text-align: center;
    color: black;
}

.description-area {
    display: flex;
    flex-direction: row;
    width: 80%;
    margin-top: 10px;
    margin-left: 10%;
    height: 50px;
    justify-content: space-between;
    align-items: flex-start;
}

.text-area{
    width: 80%;
    padding: 5px;
    margin-left: 10%;
    color: black;
    border: 1px solid black;
    border-radius: 5px;

}

.date-et-heure {
    display: flex;
    flex-direction: row;
    width: 80%;
    margin-top: 10px;
    margin-left: 10%;
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
    height: 40px;
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
    background: url('assets/icons/recherche-calendrier.png');
    background-size: 30px 30px;
    background-repeat: no-repeat;
    background-position: center;
    width: 50px;
    height: 50px;
    padding-right: 50px;
    padding-bottom: 10px;
}

.icone-heure {
    background: url('assets/icons/recherche-horloge.png');
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
    width: 250px;
    margin-left: 0%;
    text-align: center;
    justify-content: flex-start;

}

.intitule-trajet-regulier {
    margin-left: 2%;
}

.checkbox-label {
    color: black;
    font-size: 20px	;
}

.checkbox-label2 {
    color: black;
    font-size: 20px	;
    margin-right: 5%;
    margin-left: 2%;

}

.switch-container {
    display: flex;
    align-items: center;
    margin-left: 2.5%;
    position: relative;
    align-items: baseline;


}

.switch-container#switchregulier {
    color: black;
    flex-wrap: wrap;
    justify-content: center;
}

.suivant {
    background-color: #bbbbbb;
    width: 120px;
    height: 40px;
    margin: auto;
    border-radius: 10px;
}

.intitule-suivant {
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

    .entete>h1 {
        font-size: medium;
        width: 100%;
        color: black;
        text-align: center;
    }

    .bloc-de-creation {
        bottom: 80px;
        top: 80px;
    }
}

@media (max-width : 1300px) {
    .bloc-de-creation {
        width: 70%;
        left: 15%;
    }
}

@media (max-width : 900px) {
    .bloc-de-creation {
        width: 80%;
        left: 10%;
    }
}

@media (max-width : 800px) {
    .bloc-de-creation {
        width: 85%;
        left: 7.5%;
    }
}

@media (max-width : 700px) {
    .bloc-de-creation {
        width: 90%;
        left: 5%;
    }
}

@media (max-width : 600px) {
    .bloc-de-creation {
        width: 96%;
        left: 2%;
    }
}
</style>

