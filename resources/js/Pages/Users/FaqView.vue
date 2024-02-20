<template>
    <main class="bg-white dark:bg-boxdark">
        <Faq :faqs="faqs" />
    </main>
</template>

<script setup lang="ts">

import Faq from "@components/Faq/Faq.vue";

const props = defineProps({
    faqs:Object
})

</script>

<style scoped>

</style>
