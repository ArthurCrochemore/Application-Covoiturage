<!-- Représente l'affichage de un trajet pour un résultat de la recherche de trajets  -->

<script setup>
    import { ref, onMounted } from 'vue'
    import { useRouter, useRoute } from 'vue-router'
    import BlocResultatRecherche from './BlocResultatRecherche.vue'
    import axios from 'axios'

    const props = defineProps({
        idBase: Number,
        idDomicile: Number,
        booleenTrajetBaseDomicile: String,
        typeTrajet: String,
        jours: Array,
        heure: String,
        date: String
    })

    const route = useRoute();

    const idBase = ref(route.query.idBase);
    const idDomicile = ref(route.query.idDomicile);

    const resultatsRecherche = ref('')

    const response = ref()

    /**
     * Récupère tout les trajets de la base de données
     */
    const recuperationTrajets = async () => {
        try {
            if (props.typeTrajet === "Ponctuel"){
                const response = await axios.get('/api/recherche-trajets/' + props.date)
                resultatsRecherche.value = response.data
            } else {
                const response = await axios.get('/api/recherche-trajets')
                resultatsRecherche.value = response.data
            }
        } catch (error) {
            console.error('Error fetching trajets:', error)
        }
    }

    /* Constantes pour les champs des adresses */
    const domicile = ref('')
    const villeDomicile = ref('')
    const base = ref('')
    const villeBase = ref('')

    /**
     * Récupère du paramètre domicile
     */
    const recuperationDomicile = async () => {
        try {
            const response = await axios.get('/api/adresses/domicile/' + props.idDomicile)
            domicile.value = response.data.Intitule
            villeDomicile.value = response.data.Ville

            if (props.booleenTrajetBaseDomicile === "true") {
                arrive.value = villeDomicile.value
            } else {
                depart.value = villeDomicile.value
            }

        } catch (error) {
            console.error('Error fetching trajets:', error)
        }
    }

    /**
     * Récupère du paramètre base
     */
    const recuperationBase = async () => {
        try {
            const response = await axios.get('/api/adresses/base-aerienne/' + props.idBase)
            base.value = response.data.Intitule
            villeBase.value = response.data.Ville

            if (props.booleenTrajetBaseDomicile === "true") {
                depart.value = villeBase.value
            } else {
                arrive.value = villeBase.value
            }

        } catch (error) {
            console.error('Error fetching trajets:', error)
        }
    }

    /* Constantes pour l'affichage des paramètres de la recherche */
    const depart = ref("")
    const arrive = ref("")

    /**
     * Appellé au chargement de la page, récupère alors tout les trajets (TODO : faire une recherche à paramètres)
     */
    onMounted(() => {
        console.log(props.date);
        recuperationTrajets()
        recuperationDomicile()
        recuperationBase()
    })

    /* Variable pour l'affichage de l'heure */
    var directionTrajet = ref("Arrivé")
    if(props.booleenTrajetBaseDomicile === "true") {
        var directionTrajet = ref("Départ")
    }

    const router = useRouter() // Récupération du router vue-router pour la navigation

    const ptDepart = ref('')
    const ptArrive = ref('')

    /**
     * Ramène sur l'interface de recherche
     */
    const retour = () => {
        if (props.booleenTrajetBaseDomicile === "true") {
            ptArrive.value = domicile.value
            ptDepart.value = base.value
        } else {
            ptDepart.value = domicile.value
            ptArrive.value = base.value
        }

        router.push({
            path: '/recherche',
        query: {
            ptDepart: ptDepart.value,
            ptArrive: ptArrive.value,
            booleenTrajetBaseDomicile: props.booleenTrajetBaseDomicile
            }
        });
    }

    /**
     * Création d'une alerte lorsqu'un trajet correspondant est publié
     */
    function alerte() {
        window.open('https://javascript.info');

        // TODO :
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
    <div class="bloc-principal">
      <BlocResultatRecherche
            v-for="(resultat, index) in resultatsRecherche"
            :idTrajet="resultat.idTrajet"
            :ptDepart="resultat.ptDepart"
            :ptArrive="resultat.ptArrive"
            :typeTrajet="resultat.typeTrajet"
            :heureDepart="resultat.heureDepart"
            :heureArrive="resultat.heureArrive"
            :nomConducteur="resultat.nomConducteur"
            :uniteConducteur="resultat.uniteConducteur"
            :idDomicile="props.idDomicile"
        />
        <div class="alerte"
      @click="alerte()"><h1>Créer une alerte</h1></div>
    </div>
</template>

<style scoped>
    .bloc-principal {
        background-color: grey;
        top: 100px;
        bottom: 100px;
        padding : 10px 0;
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
</style>
