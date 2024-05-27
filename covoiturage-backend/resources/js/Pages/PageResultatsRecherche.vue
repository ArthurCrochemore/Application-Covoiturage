<!-- Représente l'affichage de un trajet pour un résultat de la recherche de trajets  -->

<script setup>
    import { ref, onMounted } from 'vue'
    import { useRouter, useRoute } from 'vue-router'
    import BlocResultatRecherche from './BlocResultatRecherche.vue'
    import axios from 'axios'

    const props = defineProps({
        idBase: Number,
        idDomicile: Number,
        booleenTrajetBaseDomicile: Boolean,
        typeTrajet: String,
        jours: Array,
        heure: String,
        date: String
    })

    const route = useRoute();

    const idBase = ref(route.query.idBase);
    const idDomicile = ref(route.query.idDomicile);

    const resultatsRecherche = ref('')

    /**
     * Récupère tout les trajets de la base de données
     */
    const recuperationTrajets = async () => {
        try {
            const response = await axios.get('/api/trajets')
            resultatsRecherche.value = response.data
        } catch (error) {
            console.error('Error fetching trajets:', error)
        }
    }

    const domicile = ref('')
    const villeDomicile = ref('')
    const base = ref('')
    const villeBase = ref('')

    const recuperationDomicile = async () => {
        try {
            const response = await axios.get('/api/adresses/domicile/' + idDomicile.value)
            domicile.value = response.data.Intitule
            villeDomicile.value = response.data.Ville

            if (props.booleenTrajetBaseDomicile) {
                arrive.value = villeDomicile.value
            } else {
                depart.value = villeDomicile.value
            }

        } catch (error) {
            console.error('Error fetching trajets:', error)
        }
    }

    const recuperationBase = async () => {
        try {
            const response = await axios.get('/api/adresses/base-aerienne/' + idBase.value)
            base.value = response.data.Intitule
            villeBase.value = response.data.Ville

            if (props.booleenTrajetBaseDomicile) {
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
        recuperationTrajets()
        recuperationDomicile()
        recuperationBase()
    })



    var directionTrajet = ref("Départ")
    if(props.booleenTrajetBaseDomicile) {
        directionTrajet = ref("Arrivé")
    }

    const router = useRouter() // Récupération du router vue-router pour la navigation

    const ptDepart = ref('')
    const ptArrive = ref('')

    /**
     * Ramène sur l'interface de recherche
     */
    const retour = () => {
        if (props.booleenTrajetBaseDomicile) {
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
            ptArrive: ptArrive.value
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
