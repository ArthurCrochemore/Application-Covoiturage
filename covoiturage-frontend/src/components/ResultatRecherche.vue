<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'

const props = defineProps({
  ptDepart: String,
  ptArrive: String,
  typeTrajet: String,
  heure: String,
  nomConducteur: String,
  uniteConducteur: String
})

const router = useRouter()

const ouvrir = () => {
  router.push({
    path: '/'

  });
}

</script>

<template>
    <div class="bloc-resultat" @click="ouvrir">
      <div class="bloc-heure">
        <p>{{ heure }}</p>
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
  background-color: #bbbbbb;
}
.bloc-heure {
  width : 20%;
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
  padding: 13px;
}
p {
  color : black;
  text-align: center;
  font-size: medium;
}

.bloc-resultat:hover {
  background-color: #cccccc;
}

</style>
