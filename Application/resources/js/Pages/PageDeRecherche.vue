<!-- Représente l'interface de recherche de trajets  -->

<script setup>
    import { ref, onMounted  } from 'vue'
    import { useRouter } from 'vue-router'
    import { inject } from 'vue'
    import axios from 'axios'

    const props = defineProps({
        ptDepart: String,
        ptArrive: String,
        booleenTrajetBaseDomicile : String
    })

    const afficherMessageFunc = inject('afficherMessageFunc'); // Fonction qui gère l'affichage de messages généraux sur App_Connexion.vue

    // Constantes pour contenir toutes les adresses en fonction de leur type
    const domiciles = ref('')
    const basesAeriennes = ref('')

    // Constantes contenant les adresses proposées dans les champs Départ/Arrivé
    const departs = ref()
    const arrives = ref()

    /**
     * Récupère tout les domiciles de la base de données
     */
     const recuperationDomiciles = async () => {
        try {
            const response = await axios.get('/api/adresses/domicile')
            domiciles.value = response.data

            // Chargement du contenu du menu déroulant chargé avec les domiciles
            if (props.booleenTrajetBaseDomicile == 'true') {
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
            if (props.booleenTrajetBaseDomicile === 'true') {
                departs.value = basesAeriennes.value
            } else {
                arrives.value = basesAeriennes.value
            }
        } catch (error) {
            console.error('Error fetching trajets:', error)
        }
    }

    // Constantes des contenus des différents champs Départ / Arrivé
    const depart = ref(props.ptDepart)
    const arrive = ref(props.ptArrive)
    const heure = ref()
    const date = ref()

    /**
     * Appellé au chargement de la page, récupère alors tout les trajets (TODO : faire une recherche à paramètres)
     */
    onMounted(() => {
        recuperationDomiciles()
        recuperationBases()

        // Récupération de la date et de l'heure actuelle
        const maintenant = new Date()
        const anneeActuelle = maintenant.getFullYear()
        const moisActuel = maintenant.getMonth() + 1 // Les mois commencent à partir de 0
        const jourActuel = maintenant.getDate()

        date.value = `${anneeActuelle}-${moisActuel.toString().padStart(2, '0')}-${jourActuel.toString().padStart(2, '0')}`

        const heureActuelle = maintenant.getHours()
        const minuteActuelle = maintenant.getMinutes()

        heure.value = `${heureActuelle.toString().padStart(2, '0')}:${minuteActuelle.toString().padStart(2, '0')}`

    })

    // Gèrent le grisage de la date (trajet régulier)
    const dateId = ref(['non-grise', 'grise'])
    const indexBouttonSwitch = ref(0)
    const estGrise = ref(false)
    const trajetRegulier = ref(false)

    const changerIdGrise = () => {
        indexBouttonSwitch.value = (indexBouttonSwitch.value + 1) % dateId.value.length
        estGrise.value = !estGrise.value
    }

    // Constantes de jours pour les trajets réguliers
    const lundi = ref(true)
    const mardi = ref(true)
    const mercredi = ref(true)
    const jeudi = ref(true)
    const vendredi = ref(true)
    const samedi = ref(true)
    const dimanche = ref(true)

    // Constantes pour l'affichage des données de recherche
    const typesDeTrajet = ref(['Trajet Domicile -> Base', 'Trajet Base -> Domicile'])
    const heureDepartArrive = ref(['Heure de Départ', "Heure d'Arrivé"])

    const temp = ref() // Utilisé pour l'échange de données

    // Constante pour le sens du trajet
    const booleenTrajetBaseDomicile = ref(0)
    if (props.booleenTrajetBaseDomicile === 'true') {
        booleenTrajetBaseDomicile.value = 1
    }

    /**
     * Permet l'inversion du sens du trajet
     */
     const basculerTypeDeTrajet = () => {
        booleenTrajetBaseDomicile.value = (booleenTrajetBaseDomicile.value + 1) % typesDeTrajet.value.length

        temp.value = depart.value
        depart.value = arrive.value
        arrive.value = temp.value

        /* Echange des propositions d'adresse entre les champs départ et arrivé */
        if (booleenTrajetBaseDomicile.value === 1) {
            departs.value = basesAeriennes.value
            arrives.value = domiciles.value
        } else {
            departs.value = domiciles.value
            arrives.value = basesAeriennes.value
        }

    }

    const router = useRouter() // Récupération du router vue-router pour la navigation

    // Constantes pour les passer les ids des base et domicile choisi dans la recherche
    const idDomicile = ref()
    const idBase = ref()

    /**
     * Charge tout les trajets dans le résultats de recherche
     */
    const recherche = () => {
        const trajetBaseDomicile = ref();
        if (booleenTrajetBaseDomicile.value === 1) {
            trajetBaseDomicile.value = true
        } else {
            trajetBaseDomicile.value = false
        }

        idDomicile.value = -1
        idBase.value = -1

        // On récupère les ids des champs départ/arrivé saisies
        for (const domicileParam of domiciles.value) {
            if (booleenTrajetBaseDomicile.value === 1) { // Si base
                if(domicileParam.Intitule == arrive.value) {
                    idDomicile.value = domicileParam.Id_Adresse
                }
            } else {
                if(domicileParam.Intitule == depart.value) {
                    idDomicile.value = domicileParam.Id_Adresse
                }
            }
        }
        for (const baseParam of basesAeriennes.value) {
            if (booleenTrajetBaseDomicile.value === 1) {
                if(baseParam.Intitule == depart.value) {
                    idBase.value = baseParam.Id_Adresse
                }
            } else {
                if(baseParam.Intitule == arrive.value) {
                    idBase.value = baseParam.Id_Adresse
                }
            }
        }

        let typeTrajet = ref("Ponctuel")
        if (trajetRegulier.value) {
            typeTrajet.value = "Régulier"
        }

        // S'ils ont été trouvés :
        if (idDomicile.value > -1 && idBase.value > -1) { // TODO : peut etre verifie que l'heure et la date sont anterieures
            router.push({
                path: '/resultat-recherche',
                query: {
                    idBase: idBase.value ,
                    idDomicile: idDomicile.value ,
                    booleenTrajetBaseDomicile: trajetBaseDomicile.value,
                    typeTrajet: typeTrajet.value,
                    jours: [lundi, mardi, mercredi, jeudi, vendredi, samedi, dimanche],
                    heure: heure.value,
                    date: date.value
                }
            });
        } else {
            // TODO : gestion graphique pour les champs qui poses problemes
            afficherMessageFunc("La recherche a échouée, verifiez que votre saisie est correcte", "Erreur")
        }
    }
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
            <option v-for="option in departs" :value="option.Intitule">{{option.Intitule}}</option>
        </datalist>
    </div>
    <div class="bloc-label-depart-arrive">
      <div class="icone-map"></div>
      <input list="liste-arrives" v-model="arrive" type="text" class="label" id="arrive-label" placeholder="Arrivé" />
        <datalist id="liste-arrives">
            <option v-for="option in arrives" :value="option.Intitule">{{option.Intitule}}</option>
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
    <div v-if="trajetRegulier" class="jours" id="switchregulier">
            <input type="checkbox" id="lundi" class="checkbox-input" v-model="lundi">
            <label for="lundi" class="jour">Lundi</label>
            <input type="checkbox" id="mardi" class="checkbox-input" v-model="mardi">
            <label for="mardi" class="jour">Mardi</label>
            <input type="checkbox" id="mercredi" class="checkbox-input" v-model="mercredi">
            <label for="mercredi" class="jour">Mercredi</label>
            <input type="checkbox" id="jeudi" class="checkbox-input" v-model="jeudi">
            <label for="jeudi" class="jour">Jeudi</label>
            <input type="checkbox" id="vendredi" class="checkbox-input" v-model="vendredi">
            <label for="vendredi" class="jour">Vendredi</label>
            <input type="checkbox" id="samedi" class="checkbox-input" v-model="samedi">
            <label for="samedi" class="jour">Samedi</label>
            <input type="checkbox" id="dimanche" class="checkbox-input" v-model="dimanche">
            <label for="dimanche" class="jour">Dimanche</label>
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

    .jours {
        display: flex;
        flex-direction: row;
        width: 80%;
        margin-top : 30px;
        margin-left: 10%;
        height: 50px;

        justify-content: space-between;
    }

    .jour {
        margin : auto;
        color : black;
    }
</style>


