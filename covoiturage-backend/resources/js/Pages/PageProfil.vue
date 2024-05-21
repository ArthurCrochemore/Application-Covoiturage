<script setup>
  import { ref } from 'vue'
  import { useRouter } from 'vue-router'

  const prenom = ref('Jhon')
  const nom = ref('Doe')
  const unite = ref('Unite')
  const adresse = ref('8 Rue Auguste Chevalier, Tours')
  const mail = ref('jhon@mail.com')
  const telephone = ref('+33 7 78 67 78 67')

  const router = useRouter()

  const modifier = () => {
    router.push({
    path: '/modification-profil',
    query: {
      mail: "jhon@mail.com",
      unite: "Unite",
      numPoste: "14243",
      prenom: "Jhon",
      nomFamille: "Doe",
      adressePostale: "8 Rue Auguste Chevalier, Tours",
      telephone: "+33 7 78 67 78 67"
    }
  });
}

const deconnexion = () => {
}

const rapportBug = () => {
    router.push({
    path: '/rapport-bug'
  });
}

</script>

<template>
    <div class="bloc-profil">
      <div class="bloc-identite">
        <div class="identite">
          <h3 class="prenom">{{ prenom }}</h3>
          <h3 class="nom">{{ nom }}</h3>
          <h3 class="unite">{{ unite }}</h3>
        </div>
      </div>
        <div class="bloc-informations">
          <div class="informations">
            <div class="informations-adresse">
              <div class="icone-adresse"></div>
              <h3 class="adresse">{{ adresse }}</h3>
            </div>
            <div class="informations-mail">
              <div class="icone-mail"></div>
              <h3 class="mail">{{ mail }}</h3>
            </div>
            <div class="informations-telephone">
              <div class="icone-telephone"></div>
              <h3 class="telephone">{{ telephone }}</h3>
            </div>
          </div>
        </div>
        <div class="boutons">
          <div class="modifier"
        @click="modifier"><p class="intitule-modifer">Modifier</p></div>
        <div class="deconnexion"
        @click="deconnexion"><p class="intitule-deconnexion">Déconnexion</p></div>
        </div>
        <div class="bouton-rapport-bug">
          <div class="rapport-bug"
        @click="rapportBug"><p class="intitule-rapport-bug">Rapporter un bug</p></div>
        </div>
      </div>
</template>

<style scoped>
    .bloc-profil {
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

    .bloc-identite {
      margin-top: 5%;
      width : 100%;
      height: 30%;
    }

    .identite {
      margin-left : 10%;
    }

    h3 {
        margin-top: 5px;
        color: black;
    }
    .bloc-informations {
      display: flex;
      flex-direction: column;
      width : 100%;
      height: 40%;
    }

.informations-adresse, .informations-mail, .informations-telephone {

    display: flex;
    flex-direction: row;
    height : 50px;
    width: 350px;
    margin-left : 12.5%;
    justify-content: flex-start;
    }

  .icone-adresse {
  background: url('assets/icons/navigation-map-marker.png');
  background-size: 30px 30px;
  background-repeat: no-repeat;
  background-position: center;
  width: 50px;
  height: 50px;
  margin-left: 5%;
}

.icone-mail {
  background: url('assets/icons/profil-mail.png');
  background-size: 30px 30px;
  background-repeat: no-repeat;
  background-position: center;
  width: 50px;
  height: 50px;
  margin-left: 5%;
}

.icone-telephone {
  background: url('assets/icons/profil-telephone.png');
  background-size: 30px 30px;
  background-repeat: no-repeat;
  background-position: center;
  width: 50px;
  height: 50px;
  margin-left: 5%;
}

.boutons, .bouton-rapport-bug {
  display: flex;
  flex-direction: row;
  height : 50px;
  width: 80%;
  margin-left : 10%;
  justify-content: space-between;
}

.modifier, .deconnexion, .rapport-bug {
  background-color: #bbbbbb;
  width: 120px;
  height: 35px;
  margin: auto;
  border-radius: 10px;
}

.deconnexion {
  background-color: #e33333;
}

.bouton-rapport-bug {
  border-top: auto;
  justify-content: right;
}

.rapport-bug {
  width : 300px;
}

p{
  color : black;
  text-align: center;
  font-size: 20px;
}

@media (max-height: 750px) {
    .bloc-profil {
        bottom: 80px;
        top: 80px;
    }
}

@media (max-width : 1300px) {
    .blocprofil {
        width: 70%;
        left: 15%;
    }
}

@media (max-width : 900px) {
    .bloc-profil {
        width: 80%;
        left: 10%;
    }
}

@media (max-width : 800px) {
    .bloc-profil {
        width: 85%;
        left: 7.5%;
    }
}

@media (max-width : 700px) {
    .bloc-profil {
        width: 90%;
        left: 5%;
    }
}

@media (max-width : 600px) {
    .bloc-profil {
        width: 96%;
        left: 2%;
    }
}
</style>
