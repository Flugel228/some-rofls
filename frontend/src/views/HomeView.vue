<template>
  <div class="flex flex-col w-full">
    <div class="flex flex-row justify-center mb-10">
      <img class="cursor-pointer w-16"
           src="@/assets/arrows/up-arrow.png"
           alt=""
           v-if="data?.nextHistoriesIds.length >= 1"
           @click.prevent="fetchData(data?.nextHistoriesIds[0].id)"
      >
      <img class="cursor-pointer w-16"
           src="@/assets/arrows/up-arrow.png"
           alt=""
           v-else-if="data?.nextHistoriesIds.length === 0"
           @click.prevent="fetchData()"
      >
    </div>
    <div class="flex flex-row justify-center my-auto">
      <div class="flex flex-col my-auto mr-10">
        <img class="cursor-pointer h-16 mb-5 "
             src="@/assets/arrows/arrow.png"
             alt=""
             v-if="data?.nextHistoriesIds.length >= 2"
             @click.prevent="fetchData(data?.nextHistoriesIds[1].id)"
             @keydown.right="fetchData(data?.nextHistoriesIds[1].id)"
        >
        <img class="cursor-pointer w-16 mb-5 "
             src="@/assets/arrows/arrow.png"
             alt=""
             v-else-if="data?.nextHistoriesIds.length === 0"
             @click.prevent="fetchData()"
             @keydown.right="fetchData(data?.nextHistoriesIds[1].id)"
        >
      </div>
      <div class="flex flex-col my-auto ">
      <SlideComponent v-if="data" :url="data.history.image"/>
      </div>
      <div class="flex flex-col my-auto ml-10">
        <img class="cursor-pointer h-16 mb-5 "
             src="@/assets/arrows/right-arrow.png"
             alt=""
             v-if="data?.nextHistoriesIds.length >= 3"
             @click.prevent="fetchData(data?.nextHistoriesIds[2].id)"
        >
        <img class="cursor-pointer w-16 mb-5 "
             src="@/assets/arrows/right-arrow.png"
             alt=""
             v-else-if="data?.nextHistoriesIds.length === 0"
             @click.prevent="fetchData()"
        >
      </div>
    </div>
    <div class="flex flex-row justify-center mt-5 rotate-180">
      <img class="cursor-pointer w-16"
           src="@/assets/arrows/up-arrow.png"
           alt=""
           v-if="data?.nextHistoriesIds.length === 4"
           @click.prevent="fetchData(data?.nextHistoriesIds[3].id)"
      >
      <img class="cursor-pointer w-16"
           src="@/assets/arrows/up-arrow.png"
           alt=""
           v-else-if="data?.nextHistoriesIds.length === 0"
           @click.prevent="fetchData()"
      >
    </div>
  </div>
</template>

<script setup lang="ts">
import axios from "axios";
import {onMounted, ref} from "vue";
import SlideComponent from "@/components/SlideComponent.vue";
import {History} from "@/types/views/home-view";

// declare states
const data = ref<History>();

onMounted(async () => {
  await fetchData();
  console.log(data.value?.nextHistoriesIds);
})

const fetchData = async (id: number = 0): Promise<void> => {
  const res = await axios.post('http://api.localhost:8876/api/history', {
    id
  });
  data.value = res.data
}
</script>
