<script setup>
import { ref } from 'vue'

const props = defineProps({
  message : String,
  type : String
})

</script>

<template>
    <div class="bloc-message">
        <p class="titre">{{ type }}</p>
        <p class="description">{{ message }}</p>
    </div>
</template>

<style scoped>
.bloc-message {
  background-color: rgba(161, 161, 161, 0.8);
  position : fixed;
  bottom : 95px;
  width : 95%;
  left : 2.5%;
  height : auto;
  padding : 5px;
  z-index: 9999;
}

.titre {
  font-size: larger;
}

p {
  color : black;
  text-align: center;
}
</style>
