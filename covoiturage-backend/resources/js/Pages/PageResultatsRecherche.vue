<!-- Représente l'affichage de un trajet pour un résultat de la recherche de trajets  -->

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
        resultats: Array // listes de tout les résultats de la recherche
    })

    /* Constantes pour l'affichage des paramètres de la recherche */
    const depart = ref(props.villeDomicile)
    const arrive = ref(props.base)

    var directionTrajet = ref("Départ")
    if(props.booleenTrajetBaseDomicile) {
        directionTrajet = ref("Arrivé")
    }

    const router = useRouter() // Récupération du router vue-router pour la navigation

    /**
     * Ramène sur l'interface de recherche
     */
    const retour = () => {
        router.push({
            path: '/recherche',
        query: {
            // TODO : ne plus utiliser de props

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
