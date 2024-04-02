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
    <div

      class="enfant-navigation-bar"
      :class="{ selectionne: idSelectione === 'recherche' }"
      @click="updateSelection('recherche')"
      classe-icone="recherche"
    ></div>
    <div
      class="enfant-navigation-bar"
      :class="{ selectionne: idSelectione === 'creation' }"
      @click="updateSelection('creation')"
      classe-icone="creation"
    ></div>
    <div
      class="enfant-navigation-bar"
      :class="{ selectionne: idSelectione === 'vos trajet' }"
      @click="updateSelection('vos trajet')"
      classe-icone="vos trajet"
    ></div>
    <div
      class="enfant-navigation-bar"
      :class="{ selectionne: idSelectione === 'profil' }"
      @click="updateSelection('profil')"
      classe-icone="profil"
    ></div>
    <div
      class="enfant-navigation-bar"
      :class="{ selectionne: idSelectione === 'message' }"
      @click="updateSelection('message')"
      classe-icone="message"
    ></div>
  </div>
</template>

<style scoped>
.navigation-bar {
  width: 100%;
  height : 100px;
  background-color: white;
  position: fixed;
  bottom: 0;
  left: 0;
  display: flex;
}

[classe-icone="recherche"] {
  background: url('src/assets/icons/navigation-recherche.png');
}
[classe-icone="creation"] {
  background: url('src/assets/icons/navigation-add.png');
}

[classe-icone="vos trajet"] {
  background: url('src/assets/icons/navigation-map-marker.png');
}

[classe-icone="profil"] {
  background: url('src/assets/icons/navigation-profil.png');
}

[classe-icone="message"] {
  background: url('src/assets/icons/navigation-message.png');
}

.enfant-navigation-bar {
  padding: 50px 0;
  width: 24.8%;
  margin: 0.1%;
  color: #000;
  float: left;
  text-align: center;

  background-size: 60px 60px;
  background-repeat: no-repeat;
  background-position: center;
}

.enfant-navigation-bar:hover {
  background-color: #f0f0f0;
}

.enfant-navigation-bar.selectionne {
  box-shadow: 0 0 0 2px #bbbbbb;
}

@media (max-height: 750px) {
  .navigation-bar {
    height: 60px;
  }

  .enfant-navigation-bar {
    padding: 30px 0;
    background-size: 30px 30px;
    background-repeat: no-repeat;
    background-position: center;
  }
}
</style>
