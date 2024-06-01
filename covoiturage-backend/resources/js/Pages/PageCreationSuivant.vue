<script setup>
    import { ref, onMounted  } from 'vue'
    import { useRouter } from 'vue-router'
    import { inject } from 'vue'
    import axios from 'axios'

    const props = defineProps({
        ptDepart: String,
        ptArrive: String,
        booleenTrajetBaseDomicile: Number,
        trajetRegulier: Number,
        date : String,
        heure : String,
        jours : Array,
        bagages: Number,
        nombrePassagers : Number,
        description : String
    })

    const showDialog = ref(false)
    const showAddCityDialog = ref(false)
    const newCity = ref('')
    const villesAjoutees = ref([])

    const router = useRouter() // Récupération du router vue-router pour la navigation


    onMounted(() => {
        console.log(props.ptDepart)
        console.log(props.ptArrive)
        console.log(props.trajetRegulier)
        console.log(props.date)
        console.log(props.heure)
        console.log(props.bagages)
        console.log(props.nombrePassagers)
        console.log(props.description)
        console.log(props.jours)
    })

    const retour = () => {
    router.push({
        path: '/creation-trajet',
                query: {
                    ptDepart: props.ptDepart,
                    ptArrive: props.ptArrive,
                    booleenTrajetBaseDomicile : props.booleenTrajetBaseDomicile,
                    trajetRegulier: props.trajetRegulier,
                    date : props.date,
                    heure : props.heure,
                    jours : props.jours,
                    bagages: props.bagages,
                    nombrePassagers : props.nombrePassagers,
                    description : props.description
                }
            });
    }

    const confirmerCreationTrajet = () => {
        showDialog.value = false;
        console.log("Trajet créé");
        router.push({
            path: '/vos-trajets'
        });
    }

    const ajouterVille = () => {
    console.log("Ville ajoutée :", newCity.value)
    villesAjoutees.value.push(newCity.value)
    newCity.value = ''
    showAddCityDialog.value = false
    }

    const supprimerVille = (index) => {
    villesAjoutees.value.splice(index, 1)
    }

    const creerTrajet = () => {

        axios.post('/create-trajets', {
                Date_Depart: props.date,
                Heure_Depart: props.heure,
                Nbre_Places: props.nombrePassagers,
                Qte_Bagages: props.bagages,
                Description: props.description,
                Trajet_Regulier: props.trajetRegulier,
                Domicile_Base: props.booleenTrajetBaseDomicile,
                ptDepart : props.ptDepart,
                ptArrive: props.ptArrive,
                jours: props.jours
        })
        .then(response => {
            console.log(response);
            afficherMessageFunc("Le trajet a été crée avec succès", "Succès");
            router.push({
                path: '/vos-trajets'

            });
        })
        .catch(error => {
            afficherMessageFunc(error, "Erreur");
            console.error(error);
        });
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
        <h1>Création Trajet</h1>
    </div>
    <div class = "bloc-creation-suivant">

         <!-- Zone pour afficher les villes ajoutées -->
        <div class="villes-ajoutees">
            <h3>Saisie points d'arrêts :</h3>
            <div v-for="(ville, index) in villesAjoutees" :key="index" class="ville">
                <span>{{ ville }}</span>
                <button class="bouton-supprimer" @click="supprimerVille(index)">X</button>
            </div>
        </div>

        <div class="boutons-a">
            <button class="bouton-ajouter" @click="showAddCityDialog=true">Ajouter</button>
        </div>
        <div class="boutons-s">
            <button class="bouton-creer" @click="showDialog = true">Créer</button>
            <button class="bouton-precedent"  @click="retour()">Précédent</button>
        </div>
    </div>

     <!-- Boîte de dialogue pour ajouter une ville -->
     <div v-if="showAddCityDialog" class="dialog">
      <div class="dialog-content">
        <h2>Ajouter une ville</h2>
        <input type="text" v-model="newCity" placeholder="Saisir le nom de la ville" />
        <div class="dialog-buttons">
          <button class="bouton-creer" @click="ajouterVille">Ajouter</button>
          <button class="bouton-annuler" @click="showAddCityDialog = false">Annuler</button>
        </div>
      </div>
    </div>

    <!-- Boîte de dialogue pour confirmer la création du trajet -->
    <div v-if="showDialog" class="dialog">
        <div class="dialog-content">
            <h2>Confirmation</h2>
            <p>Êtes-vous sûr de vouloir créer ce trajet ?</p>
            <div class="dialog-buttons">
                <button class="bouton-creer" @click="confirmerCreationTrajet">Confirmer</button>
                <button class="bouton-annuler" @click="showDialog=false">Annuler</button>
            </div>
        </div>
    </div>

</template>

<style scoped>

.dialog {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
}

.dialog-content {
  background-color: white;
  padding: 20px;
  border-radius: 5px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}
.dialog-buttons {
    padding-top: 40px;
  display: flex;
  justify-content: space-between;
}
.entete {
    width: 100%;
    height: 100px;
    background-color: white;
    position: fixed;
    top: 0;
    left: 0;
    display: flex;
    flex-direction: column;
}

.retour {
    width : 60px;
    height: 60px;
    top : 20px;
    left : 20px;
    position : absolute;
}

.entete > h1 {
    width : 100%;
    color : black;
    text-align: center;
}

p, h2, h3{
    color: black;
}
.bouton-ajouter,
.bouton-creer,
.bouton-precedent,
.bouton-annuler {
    width: 130px;
    height: 30px;
    border-radius: 10%;
}
.boutons-a {
    display: flex;
    flex-direction: row;
    margin: 10px 0;
    justify-content: flex-end;
}
.boutons-s {
    display: flex;
    margin: 10px 0;
    justify-content: space-between;
    flex-direction: row-reverse;
}
.bouton-creer{
    background-color: green;
}


.bloc-creation-suivant{
  width: 60%;
  height: auto;
  position: fixed;
  top: 100px;
  bottom: 100px;
  padding : 10px 0;
  left: 20%;
  display: flex;
  flex-direction: column;
  overflow-y: auto;
}

.villes-ajoutees {
  margin-top: 20px;
}

.villes-ajoutees h3 {
  margin-bottom: 10px;
}

.ville {
    color: black;
  background-color: #f0f0f0;
  padding: 10px;
  margin-bottom: 10px;
  border-radius: 5px;
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.ville span {
  margin-right: 10px;
}

.bouton-supprimer {
  color: black;
  background-color: transparent;
  border: none;
  font-size: 16px;
  cursor: pointer;
}


@media (max-height: 750px) {
    .entete {
        height: 60px;
    }
    .retour {
        background-size: 30px 30px;

    }
    .entete > h1 {
        font-size: medium;
        width : 100%;
        color : black;
        text-align: center;
    }
    .bloc-creation-suivant {
        bottom: 80px;
        top: 80px;
    }
}

@media (max-width : 1300px) {
    .bloc-creation-suivant {
        width: 70%;
        left: 15%;
    }
}

@media (max-width : 900px) {
    .bloc-creation-suivant {
        width: 80%;
        left: 10%;
    }
}

@media (max-width : 800px) {
    .bloc-creation-suivant {
        width: 85%;
        left: 7.5%;
    }
}

@media (max-width : 700px) {
    .bloc-creation-suivant {
        width: 90%;
        left: 5%;
    }
    .entete > h1 {
        font-size: 20px;
        margin: auto 0;
    }
}

@media (max-width : 600px) {
    .bloc-creation-suivant {
        width: 96%;
        left: 2%;
    }
}
</style>
