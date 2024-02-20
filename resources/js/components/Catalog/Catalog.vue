<template>
    <div class="products grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-8 lg:gap-y-10 2xl:gap-y-12 py-20">
       <Index :products="products"/>
    </div>


</template>

<script setup lang="ts">
import Index from "@components/Product/Index.vue";

defineProps(['products'])
</script>

<style scoped>

</style>
