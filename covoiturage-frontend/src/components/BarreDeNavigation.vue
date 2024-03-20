<script setup>
import { ref } from 'vue'

const idSelectione = ref('recherche')

function updateSelection(id) {
  idSelectione.value = id
}
</script>

<template>
  <div class="navigation-bar">
    <div
      class="enfant-navigation-bar"
      :class="{ selectionne: idSelectione === 'recherche' }"
      @click="updateSelection('recherche')"
    >
      Recherche
    </div>
    <div
      class="enfant-navigation-bar"
      :class="{ selectionne: idSelectione === 'creation' }"
      @click="updateSelection('creation')"
    >
      Creation
    </div>
    <div
      class="enfant-navigation-bar"
      :class="{ selectionne: idSelectione === 'vos trajet' }"
      @click="updateSelection('vos trajet')"
    >
      Vos Trajets
    </div>
    <div
      class="enfant-navigation-bar"
      :class="{ selectionne: idSelectione === 'profil' }"
      @click="updateSelection('profil')"
    >
      Profil
    </div>
    <div
      class="enfant-navigation-bar"
      :class="{ selectionne: idSelectione === 'message' }"
      @click="updateSelection('message')"
    >
      Message
    </div>
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
  padding: 40px 0;
  width: 25%;
  color: #000;
  float: left;
  text-align: center;
}

.enfant-navigation-bar:hover {
  background-color: #f0f0f0;
}

.selectionne {
  background-color: #7e7b7b;
}
</style>
