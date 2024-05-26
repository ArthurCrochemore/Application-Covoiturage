<!-- Page pour la réinitialisation du mot de passe  -->
<!-- TODO : A integrer correctement (lien depuis mail) -->
<script setup>
    import { ref } from 'vue'

    const motdepasse = ref('')
    const confirmationmotdepasse = ref('')

    const valider = () => {
        console.log("Mot de passe:", motdepasse.value)
        console.log("Mot de passe:", confirmationmotdepasse.value)

        // TODO : effectuer la modification du mot de passe
    }

    const annuler = () => {
    }
</script>

<template>
  <div class="bloc-connexion">
    <h1>Mot de passe oublié</h1>
    <div class="bloc-label">
      <div class="icone-cadenas" id="icone"></div>
      <input type="password" class="label" v-model="motdepasse" placeholder="Mot de Passe" />
    </div>
    <div class="bloc-label">
      <div class="icone-cadenas" id="icone"></div>
      <input type="password" class="label" v-model="confirmationmotdepasse" placeholder="Confirmer le mot de Passe" />
    </div>
    <div class="boutons">
        <div class="annuler"
        @click="annuler"><p class="intitule-annuler">Annuler</p></div>
          <div class="valider"
        @click="valider"><p class="intitule-valider">Valider</p></div>
        </div>
  </div>
</template>

<style scoped>
.bloc-connexion {
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

.bloc-label {
  display: flex;
  flex-direction: row;
  height : 50px;
  width: 75%;
  margin-left : 12.5%;
  justify-content: space-between;
  margin-bottom : 10px;
}

input {
  width : 90%;
  font-size: medium;
  border : none;
  border-bottom: 1px solid #dddddd;
}

#icone {
  background-size: 30px 30px;
  background-repeat: no-repeat;
  background-position: center;
  width: 50px;
  height: 50px;
}

.icone-cadenas {
  background: url('assets/icons/connexion-cadenas.png');
}

h1 {
  margin-bottom : 40px;
}

p, h1 {
  text-align: center;
  border-top: 5px;
  color: black;
}

.boutons {
  display: flex;
  flex-direction: row;
  height : 50px;
  width: 80%;
  margin-left : 10%;
  margin-top : 20px;
  justify-content: space-between;
}

.annuler, .valider {
  background-color: #bbbbbb;
  width: 120px;
  height: 35px;
  margin: auto;
  border-radius: 10px;
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
    .bloc-connexion {
        bottom: 80px;
        top: 80px;
    }
}

@media (max-width : 1300px) {
    .bloc-connexion {
        width: 70%;
        left: 15%;
    }
}

@media (max-width : 900px) {
    .bloc-connexion {
        width: 80%;
        left: 10%;
    }
}

@media (max-width : 800px) {
    .bloc-connexion {
        width: 85%;
        left: 7.5%;
    }
}

@media (max-width : 700px) {
    .bloc-connexion {
        width: 90%;
        left: 5%;
    }
}

@media (max-width : 600px) {
    .bloc-connexion {
        width: 96%;
        left: 2%;
    }
}
</style>


