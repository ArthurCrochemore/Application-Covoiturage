<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'


const dialog = ref(false)

const router = useRouter()
const retour = () => {
  router.push({
    path: '/creation-trajet'

  });
}

const creerTrajet = () => {
    dialog.value = true
}

const confirmerCreationTrajet = () => {
    // Code pour la confirmation de création du trajet
    dialog.value = false
}

const annulerCreationTrajet = () => {
    // Code pour annuler la création du trajet
    dialog.value = false
}

</script>
<template>
    <div class="entete">
        <div
      class="retour"
      style="
        background: url('src/assets/icons/fleche_retour.png');
        background-size: 60px 60px;
        background-repeat: no-repeat;
        background-position: center;
      "
      @click="retour()"
    ></div>
        <h1>Creation Trajet</h1>
    </div>
    <div class = "bloc-creation-suivant">
        <div class ="title-page">
            <p>Ajouter des points d'arrêts :</p>
        </div>
        <div class="boutons-a">
            <button class="bouton-ajouter" >Ajouter</button>
        </div>
        <div class="boutons-s">
            <button class="bouton-creer" @click="creerTrajet">Créer</button>
            <button class="bouton-precedent"  @click="retour()">Précédent</button>
        </div>
    </div>
    <v-dialog v-model="dialog" max-width="500px">
        <template #activator="{ on }">
            <button v-on="on" style="display: none;"></button>
        </template>
        <v-card>
            <v-card-title>
                Confirmation
            </v-card-title>
            <v-card-text>
                Êtes-vous sûr de vouloir créer ce trajet ?
            </v-card-text>
            <v-card-actions>
                <v-btn color="green darken-1" text @click="confirmerCreationTrajet">Confirmer</v-btn>
                <v-btn color="red darken-1" text @click="annulerCreationTrajet">Annuler</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
   
</template>

<style scoped>
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

p{
    color: black;
}
.bouton-ajouter,
.bouton-creer,
.bouton-precedent {
    width: 150px;
    height: 40px;
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