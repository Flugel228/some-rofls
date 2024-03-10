<script setup lang="ts">
// eslint-disable-next-line no-undef
const props = defineProps<{
  url: string
}>();
</script>

<template>
  <img class=" w-96 h-96" :src="props.url" alt="">
</template>

<style scoped>

</style>