<!-- Représente l'affichage de un trajet pour un résultat de la recherche de trajets  -->

<script setup>
    import { ref } from 'vue'
    import { useRouter } from 'vue-router'

    const props = defineProps({
        idTrajet : Number,
        ptDepart: String,
        ptArrive: String,
        typeTrajet: String,
        heureDepart: String,
        heureArrive: String,
        nomConducteur: String,
        uniteConducteur: String,
        idDomicile: Number
    })

    const idTrajet = ref(props.idTrajet) // On stocke le props de l'id du trajet dans une constante pour puvoir l'utiliser dans la réservation
    const idDomicile = ref(props.idDomicile)

    const router = useRouter() // Récupération du router vue-router pour la navigation

    /**
     * Charge l'affichage détaillé du trajet, où la réservation est possible
     */
    const ouvrir = () => {
        console.log(idTrajet.value)

        router.push({path: '/detail-trajet-reservation',
            query: {
                idTrajet: idTrajet.value,
                idDomicile: idDomicile.value
            }
        });
    }
</script>

<template>
    <div class="bloc-resultat" @click="ouvrir">
      <div class="bloc-heure">
        <p>{{ heureDepart }}</p>
        <p>{{ heureArrive }}</p>
      </div>
      <div class="bloc-depart-arrive">
        <p>{{ ptDepart }}</p>
        <p>{{ ptArrive }}</p></div>
      <div class="bloc-conducteur">
        <p>{{ nomConducteur }}</p>
        <p>{{ uniteConducteur }}</p></div>
    </div>
</template>

<style scoped>
    .bloc-resultat {
    display: flex;
    flex-direction: row;
    border-radius: 20px;
    background-color: white;
    box-shadow: #eeeeee;
    }
    .bloc-heure {
    width : 20%;
    border-right: 1px solid black;
    }
    .bloc-depart-arrive {
    width : 45%;
    }
    .bloc-conducteur {
    width : 35%;
    }
    .bloc-conducteur, .bloc-depart-arrive, .bloc-heure {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    margin: 13px;
    }
    p {
    color : black;
    text-align: center;
    font-size: medium;
    }

    .bloc-resultat:hover {
    background-color: #eeeeee;
    }
</style>
