<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { defineProps } from 'vue'
import { inject } from 'vue'

const afficherMessageFunc = inject('afficherMessageFunc');

const props = defineProps({
  mail: String,
  unite: String,
  numPoste: String,
  prenom: String,
  nomFamille: String,
  adressePostale: String,
  telephone: String
})

const router = useRouter()

const retour = () => {
  router.push({
    path: '/profil'

  });
  }

  const valider = () => {
  afficherMessageFunc("La demande de modification a été enregistrée avec succèes", "Succès");
  retour();
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
        <h1>Modification du Profil</h1>
  </div>
  <div class="bloc-modification-profil">
    <div class="bloc-haut"></div>
    <div class="bloc-label">
      <input type="text" class="label" id="mail-label" placeholder="Mail" v-model="mailValue"/>
    </div>
    <div class="bloc-label">
      <input type="text" class="label" id="unite-label" placeholder="N° Unité" v-model="uniteValue"/>
    </div>
    <div class="bloc-label">
      <input type="text" class="label" id="num-poste-label" placeholder="N° de Poste" v-model="numPosteValue"/>
    </div>
    <div class="bloc-label">
      <input type="text" class="label" id="prenom-label" placeholder="Prénom" v-model="prenomValue"/>
    </div>
    <div class="bloc-label">
      <input type="text" class="label" id="nom-famille-label" placeholder="Nom de Famille" v-model="nomFamilleValue"/>
    </div>
    <div class="bloc-label">
      <input type="text" class="label" id="adresse-postale-label" placeholder="Adresse Postale" v-model="adressePostaleValue"/>
    </div>
    <div class="bloc-label">
      <input type="text" class="label" id="telephone-label" placeholder="Téléphone" v-model="telephoneValue"/>
    </div>

    <div class="boutons">
      <div class="valider"
          @click="valider"><p class="intitule-valider">Valider</p></div>
    </div>
  </div>
</template>

<script>

export default {
    name: 'BlocModificationProfil',
    data() {
        return {
          mailValue: this.mail,
          uniteValue: this.unite,
          numPosteValue: this.numPoste,
          prenomValue: this.prenom,
          nomFamilleValue: this.nomFamille,
          adressePostaleValue: this.adressePostale,
          telephoneValue: this.telephone
                }
      }

}
</script>

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
    margin : auto;
}

.bloc-modification-profil {
  width: 60%;
  height: auto;
  position: fixed;
  top: 150px;
  bottom: 150px;
  left: 20%;
  display: flex;
  flex-direction: column;
  background-color: white;
    border-radius: 40px;
}

.bloc-haut {
  height: 3%;
}

.bloc-label {
  display: flex;
  width : 90%;
  padding-left: 7.5%;
  height: 8%;
}

.label {
  border: none;
  border-bottom: 1px solid #dddddd;
  height: 40px;
  font-size: medium;
  width: 100%;
}

.boutons {
  display: flex;
  flex-direction: row;
  height : 50px;
  width: 80%;
  justify-content: right;
  margin-top: auto;
}

.valider {
  background-color: #bbbbbb;
  width: 120px;
  height: 35px;
  border-radius: 10px;
}

p{
  color : black;
  text-align: center;
  font-size: 20px;
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
    .bloc-modification-profil {
        bottom: 80px;
        top: 80px;
    }
}

@media (max-width : 1300px) {
    .bloc-modification-profil {
        width: 70%;
        left: 15%;
    }
}

@media (max-width : 900px) {
    .bloc-modification-profil {
        width: 80%;
        left: 10%;
    }
}

@media (max-width : 800px) {
    .bloc-modification-profil {
        width: 85%;
        left: 7.5%;
    }
}

@media (max-width : 700px) {
    .bloc-modification-profil {
        width: 90%;
        left: 5%;
    }
    .entete > h1 {
        font-size: 20px;
        margin: auto 0;
    }
}

@media (max-width : 600px) {
    .bloc-modification-profil {
        width: 96%;
        left: 2%;
    }
}
</style>
