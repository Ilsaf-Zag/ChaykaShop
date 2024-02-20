<template>
    <div class="container px-6 py-12 mx-auto">
        <h1 class="text-2xl font-semibold text-gray-800 lg:text-3xl dark:text-white">Frequently asked questions</h1>

        <div v-for="faq in faqs" :key="faq.id">
            <FaqItem
                :faq="faq"
            />
        </div>
    </div>
</template>

<script setup lang="ts">
import FaqItem from "@components/Faq/FaqItem.vue";

const props = defineProps(['faqs'])

</script>


<style scoped>

</style>
