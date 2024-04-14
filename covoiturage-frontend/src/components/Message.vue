<script setup>
import { ref } from 'vue'

const props = defineProps({
  message : String,
  type : String
})

</script>

<template>
    <div class="bloc-message">
        <p>{{ type }}</p>
        <p>{{ message }}</p>
    </div>
</template>

<style scoped>
.bloc-message {
  position : fixed;
  bottom : 95px;
  width : 95%;
  left : 2.5%;
  height : auto;
  z-index: 9999;
}

p {
  color : grey;
}
</style>
