<script setup lang="ts">
import { ref } from 'vue'
import Show from "@components/Product/Index.vue";

defineProps({
    product:Object,
    sizes: Object
})

const pageTitle = ref('Товары')

</script>
<style>

</style>


<template>
    <Show :products="products" :sizes="sizes"/>
</template>
