<script setup>
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { inject } from 'vue'
import axios from 'axios'

const props = defineProps({
    ptDepart: String,
    ptArrive: String,
    booleenTrajetBaseDomicile: Number,
    trajetRegulier: Number,
    date: String,
    heure: String,
    jours: Array,
    bagages: Number,
    nombrePassagers: Number,
    description: String
})

const router = useRouter() // Récupération du router vue-router pour la navigation

const afficherMessageFunc = inject('afficherMessageFunc'); // Fonction qui gère l'affichage de messages généraux sur App_Connexion.vue

// Constantes pour contenir toutes les adresses en fonction de leur type (domicile ou base)
const domiciles = ref('')
const basesAeriennes = ref('')
const departs = ref()
const arrives = ref()

// Initialisation des constantes vis à vis des props
const depart = ref(props.ptDepart)
const arrive = ref(props.ptArrive)
const booleenTrajetBaseDomicile = ref(Boolean(Number(props.booleenTrajetBaseDomicile)))
const heure = ref(props.heure)
const date = ref(props.date)
const bagage = ref(props.bagages)
const nombrePassagers = ref(props.nombrePassagers)
const description = ref(props.description)
const trajetRegulier = ref(Boolean(Number(props.trajetRegulier)))

const lundi = ref(props.jours[0])
const mardi = ref(props.jours[1])
const mercredi = ref(props.jours[2])
const jeudi = ref(props.jours[3])
const vendredi = ref(props.jours[4])
const samedi = ref(props.jours[5])
const dimanche = ref(props.jours[6])

/**
 * Récupère tout les domiciles de la base de données
 */
const recuperationDomiciles = async () => {
    try {
        const response = await axios.get('/api/adresses/domicile')
        domiciles.value = response.data

        // Chargement du contenu du menu déroulant chargé avec les domiciles
        if (props.booleenTrajetBaseDomicile == '1') {
            arrives.value = domiciles.value
        } else {
            departs.value = domiciles.value
        }
    } catch (error) {
        console.error('Error fetching trajets:', error)
    }
}

/**
 * Récupère toutes les bases aériennes de la base de données
 */
const recuperationBases = async () => {
    try {
        const response = await axios.get('/api/adresses/base-aerienne')
        basesAeriennes.value = response.data

        // Chargement du contenu du menu déroulant chargé avec les bases
        if (props.booleenTrajetBaseDomicile === '1') {
            departs.value = basesAeriennes.value
        } else {
            arrives.value = basesAeriennes.value
        }
    } catch (error) {
        console.error('Error fetching trajets:', error)
    }
}

/**
 * Appellé au chargement de la page, récupère alors tout les trajets (TODO : faire une recherche à paramètres)
 */
onMounted(() => {
    recuperationDomiciles()
    recuperationBases()
})

// Gèrent le grisage de la date (trajet régulier)
const dateId = ref(['non-grise', 'grise'])
const indexBouttonSwitch = ref(0)
const estGrise = ref(false)

const changerIdGrise = () => {
    indexBouttonSwitch.value = (indexBouttonSwitch.value + 1) % dateId.value.length
    estGrise.value = !estGrise.value
}

const temp = ref() // Utilisé pour l'échange de données

/**
 * Permet l'inversion du sens du trajet
 */
const basculerTypeDeTrajet = () => {
    temp.value = depart.value
    depart.value = arrive.value
    arrive.value = temp.value

    booleenTrajetBaseDomicile.value = !booleenTrajetBaseDomicile.value

    /* Echange des propositions d'adresse entre les champs départ et arrivé */
    if (trajetRegulier) {
        departs.value = basesAeriennes.value
        arrives.value = domiciles.value
    } else {
        departs.value = domiciles.value
        arrives.value = basesAeriennes.value
    }
}

const verificationChamps = () => {
    //Si un des champs est vide ou si le nombre de passagers inférieur à 1
    if (!depart.value || !arrive.value || !date.value || !heure.value || nombrePassagers.value < 1) {
        let champsManquants = [];
        if (!depart.value) champsManquants.push("Départ");
        if (!arrive.value) champsManquants.push("Arrivée");
        if (!date.value) champsManquants.push("Date");
        if (!heure.value) champsManquants.push("Heure");
        if (nombrePassagers.value < 1) champsManquants.push("Nombre de passagers doit être supérieur à 0");

        alert(`Erreur dans le champ suivant: ${champsManquants.join(", ")}`);
        return false; // Annule la navigation si des champs sont manquants
    }
    return true; // Autorise la navigation si tous les champs sont remplis
}

const pageSuivante = () => {
    if (verificationChamps()) {
        // Si tous les champs sont remplis, naviguer vers la page suivante
        var jours = [lundi.value, mardi.value, mercredi.value, jeudi.value, vendredi.value, samedi.value, dimanche.value];

        router.push({
            path: '/creation-suivant',
            query: {
                ptDepart: depart.value,
                ptArrive: arrive.value,
                booleenTrajetBaseDomicile: Number(booleenTrajetBaseDomicile.value),
                trajetRegulier: Number(trajetRegulier.value),
                date: date.value,
                heure: heure.value,
                jours: jours,
                bagages: bagage.value,
                nombrePassagers: nombrePassagers.value,
                description: description.value
            }
        });
    }
}

</script>

<template>
    <div class="bloc-principal">
        <div class="titre-bloc">
            <h1 class="intitule-creation">Création d'un trajet</h1>
        </div>
        <div class="bloc-label-depart-arrive">
            <div class="icone-map"></div>
            <input list="liste-departs" v-model="depart" type="text" class="label" id="depart-label"
                placeholder="Départ" />
            <datalist id="liste-departs">
                <option v-for="option in departs" :value="option.Intitule">{{ option.Intitule }}</option>
            </datalist>
        </div>
        <div class="icone-arrows" @click="basculerTypeDeTrajet">
        </div>
        <div class="bloc-label-depart-arrive">
            <div class="icone-map"></div>
            <input list="liste-arrives" v-model="arrive" type="text" class="label" id="arrive-label"
                placeholder="Arrivée" />
            <datalist id="liste-arrives">
                <option v-for="option in arrives" :value="option.Intitule">{{ option.Intitule }}</option>
            </datalist>
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
            <input type="checkbox" id="lundi" class="checkbox-input" v-model="lundi">
            <label for="lundi" class="checkbox-label2">Lundi</label>
            <input type="checkbox" id="mardi" class="checkbox-input" v-model="mardi">
            <label for="mardi" class="checkbox-label2">Mardi</label>
            <input type="checkbox" id="mercredi" class="checkbox-input" v-model="mercredi">
            <label for="mercredi" class="checkbox-label2">Mercredi</label>
            <input type="checkbox" id="jeudi" class="checkbox-input" v-model="jeudi">
            <label for="jeudi" class="checkbox-label2">Jeudi</label>
            <input type="checkbox" id="vendredi" class="checkbox-input" v-model="vendredi">
            <label for="vendredi" class="checkbox-label2">Vendredi</label>
            <input type="checkbox" id="samedi" class="checkbox-input" v-model="samedi">
            <label for="samedi" class="checkbox-label2">Samedi</label>
            <input type="checkbox" id="dimanche" class="checkbox-input" v-model="dimanche">
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
        <div class="suivant" @click="pageSuivante">
            <p class="intitule-suivant">Suivant</p>
        </div>
    </div>
</template>


<style scoped>
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

.text-area {
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
    font-size: 20px;
}

.checkbox-label2 {
    color: black;
    font-size: 20px;
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
</style>
