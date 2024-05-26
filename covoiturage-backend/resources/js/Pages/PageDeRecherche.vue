<!-- Représente l'interface de recherche de trajets  -->

<script setup>
    import { ref, onMounted  } from 'vue'
    import axios from 'axios'
    import { useRouter } from 'vue-router'

    const props = defineProps({
        domiciles: Array,
        villeDomiciles: Array,
        basesAeriennes: Array,
        villeBases: Array,
        ptDepart: String,
        ptArrive: String
    })

    // TODO : à voir en fonction de  comment sont gérés les adresses (SI suppresion, supprimer aussi dans les props)
    const departs = ref(props.domiciles)
    const arrives = ref(props.basesAeriennes)
    const depart = ref(props.ptDepart)
    const arrive = ref(props.ptArrive)

    // Constantes pour l'affichage des données de recherche
    const typesDeTrajet = ref(['Trajet Base -> Domicile', 'Trajet Domicile -> Base'])
    const heureDepartArrive = ref(['Heure de Départ', "Heure d'Arrivé"])
    const booleenTrajetBaseDomicile = ref(0)

    // Gèrent le grisage de la date (trajet régulier)
    const dateId = ref(['non-grise', 'grise'])
    const indexBouttonSwitch = ref(0)
    const estGrise = ref(false)

    const changerIdGrise = () => {
        indexBouttonSwitch.value = (indexBouttonSwitch.value + 1) % dateId.value.length
        estGrise.value = !estGrise.value
    }

    /**
     * Permet l'inversion du sens du trajet
     */
    const basculerTypeDeTrajet = () => {
        booleenTrajetBaseDomicile.value = (booleenTrajetBaseDomicile.value + 1) % typesDeTrajet.value.length
        depart.value = ""
        arrive.value = ""

        /* Echange des propositions d'adresse entre les champs départ et arrivé */
        if (booleenTrajetBaseDomicile.value === 0) {
            departs.value = props.domiciles.slice()
            arrives.value = props.basesAeriennes.slice()
        } else {
            departs.value = props.basesAeriennes.slice()
            arrives.value = props.domiciles.slice()
        }
    }

    const router = useRouter() // Récupération du router vue-router pour la navigation

    // Données pour tester le front: TODO : supprimer
    const resultatsRecherche = () => {
    return [
    {
        idTrajet: 1,
        ptDepart: "Paris",
        ptArrive: "Base Aérienne",
        typeTrajet: "Régulier",
        heureDepart: "",
        heureArrive: "10h45",
        nomConducteur: "John",
        uniteConducteur: "67890"
        },
        {
        idTrajet: 1,
        ptDepart: "St Avertin",
        ptArrive: "Base Aérienne",
        typeTrajet: "Régulier",
        heureDepart: "",
        heureArrive: "10h50",
        nomConducteur: "Marie",
        uniteConducteur: "9076908769"
        },
        {
        idTrajet: 1,
        ptDepart: "Paris",
        ptArrive: "Base Aérienne",
        typeTrajet: "Régulier",
        heureDepart: "",
        heureArrive: "10h45",
        nomConducteur: "John",
        uniteConducteur: "67890"
        },
        {
        idTrajet: 1,
        ptDepart: "Paris",
        ptArrive: "Base Aérienne",
        typeTrajet: "Régulier",
        heureDepart: "",
        heureArrive: "10h45",
        nomConducteur: "John",
        uniteConducteur: "67890"
        },
        {
        idTrajet: 1,
        ptDepart: "Paris",
        ptArrive: "Base Aérienne",
        typeTrajet: "Régulier",
        heureDepart: "",
        heureArrive: "10h45",
        nomConducteur: "John",
        uniteConducteur: "67890"
        },
        {

        idTrajet: 1,
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

        idTrajet: 1,
        ptDepart: "Paris",
        ptArrive: "Base Aérienne",
        typeTrajet: "Régulier",
        heureDepart: "",
        heureArrive: "10h45",
        nomConducteur: "John",
        uniteConducteur: "67890"
        },
        {

        idTrajet: 1,
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

    /**
     * Récupère tout les trajets de la base de données
     */
    const fetchTrajets = async () => {
        try {
            const response = await axios.get('/api/trajets')
            resultatsRecherche.value = response.data
        } catch (error) {
            console.error('Error fetching trajets:', error)
        }
    }

    /**
     * Charge tout les trajets dans le résultats de recherche
     */
    const recherche = () => {
        const trajetBaseDomicile = Boolean(booleenTrajetBaseDomicile);

        router.push({
            path: '/resultat-recherche',
            query: {
            domicile: 'Rue de la Fortilière, St Avertin',
            villeDomicile: 'St Avertin',
            base: "Base aerienne de Tours",
            villeBase: "Tours",
            booleenTrajetBaseDomicile: trajetBaseDomicile,
            typeTrajet: 'Regulier',
            heure: '10h50',
            resultats : JSON.stringify(resultatsRecherche.value)
            }
        });
    }

    // TODO : supprimer pour ne récupérer les données que lors de la recherche et pas avant
    onMounted(() => {
        fetchTrajets()
    })
</script>

<template>
  <div class="bloc-principal">
    <div class="type-de-trajet" @click="basculerTypeDeTrajet">
      <h1 class="intitule-type-de-trajet">{{ typesDeTrajet[booleenTrajetBaseDomicile] }}</h1>
    </div>
    <div class="bloc-label-depart-arrive">
      <div class="icone-map"></div>
      <input list="liste-departs" v-model="depart" type="text" class="label" id="depart-label" placeholder="Départ" />
      <datalist id="liste-departs">
            <option v-for="option in departs" :value="option">{{option}}</option>
        </datalist>
    </div>
    <div class="bloc-label-depart-arrive">
      <div class="icone-map"></div>
      <input list="liste-arrives" v-model="arrive" type="text" class="label" id="arrive-label" placeholder="Arrivé" />
        <datalist id="liste-arrives">
            <option v-for="option in arrives" :value="option">{{option}}</option>
        </datalist>
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
        heure: '',
        date: '',
        trajetRegulier: ''
        }
    }
    }
    </script>

    <style scoped>

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
        background: url('assets/icons/navigation-map-marker.png');
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
    width: 190px;
    margin: auto;
    text-align: center;

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


</style>


