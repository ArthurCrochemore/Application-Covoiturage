<template>
  <div>
    <v-dialog v-model="dialog">
    <v-date-picker @click="handleDatePickerClick"></v-date-picker>
    </v-dialog>
  </div>
</template>

<script>
export default {
  data() {
    return {
      dialog: false
    };
  },
  methods: {
    handleDatePickerClick() {
      this.$emit('date-picker-click');
    }
  }
}
</script>
