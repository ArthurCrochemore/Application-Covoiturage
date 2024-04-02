<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'

const idSelectione = ref('recherche')
const router = useRouter()

function updateSelection(id) {
  console.log(id) 
  idSelectione.value = id
  if (id === 'creation') {
    router.push('/creation-trajet')
  }
}
</script>

<template>
  <div class="navigation-bar">
    <div class="enfant-navigation-bar" style="
        background: url('src/assets/icons/navigation-recherche.png');
        background-size: 60px 60px;
        background-repeat: no-repeat;
        background-position: center;
      " :class="{ selectionne: idSelectione === 'recherche' }" @click="updateSelection('recherche')"></div>
    <div class="enfant-navigation-bar" style="
        background: url('src/assets/icons/navigation-add.png');
        background-size: 60px 60px;
        background-repeat: no-repeat;
        background-position: center;
      " :class="{ selectionne: idSelectione === 'creation' }" @click="updateSelection('creation')"></div>
    <div class="enfant-navigation-bar" style="
        background: url('src/assets/icons/navigation-map-marker.png');
        background-size: 60px 60px;
        background-repeat: no-repeat;
        background-position: center;
      " :class="{ selectionne: idSelectione === 'vos trajet' }" @click="updateSelection('vos trajet')"></div>
    <div class="enfant-navigation-bar" style="
        background: url('src/assets/icons/navigation-profil.png');
        background-size: 60px 60px;
        background-repeat: no-repeat;
        background-position: center;
      " :class="{ selectionne: idSelectione === 'profil' }" @click="updateSelection('profil')"></div>
    <div class="enfant-navigation-bar" style="
        background: url('src/assets/icons/navigation-message.png');
        background-size: 60px 60px;
        background-repeat: no-repeat;
        background-position: center;
      " :class="{ selectionne: idSelectione === 'message' }" @click="updateSelection('message')"></div>
  </div>
</template>

<style scoped>
.navigation-bar {
  width: 100%;
  background-color: white;
  position: fixed;
  bottom: 0;
  left: 0;
  display: flex;
}

.enfant-navigation-bar {
  padding: 50px 0;
  width: 24.8%;
  margin: 0.1%;
  color: #000;
  float: left;
  text-align: center;
}

.enfant-navigation-bar:hover {
  background-color: #f0f0f0;
}

.enfant-navigation-bar.selectionne {
  box-shadow: 0 0 0 2px #bbbbbb;
}

i {
  height: 60px;
  width: 60px;
  background-size: cover;
  background-repeat: no-repeat;
}
</style>
