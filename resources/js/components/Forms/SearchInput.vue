<script setup lang="ts">

import {defineModel} from "vue";

const model = defineModel()

</script>

<template>
    <input
        type="text"
        v-model="model"
        placeholder="Поиск..."
        class="dark:bg-boxdark border border-gray text-gray text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-60 p-2.5"
    />
</template>
