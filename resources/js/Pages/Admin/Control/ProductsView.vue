<script setup lang="ts">
import {ref} from 'vue'
import BreadcrumbDefault from '@components/Breadcrumbs/BreadcrumbDefault.vue'
import Products from '@components/Control/Products.vue'
import AdminLayout from '@layouts/AdminLayout.vue'

const pageTitle = ref('Управление')

defineOptions({layout: AdminLayout})

defineProps({
    products: {
        type: Object,
        default: () => ({}),
    },
    filters: {
        type: Object,
        default: () => ({}),
    },
})

</script>

<template>
    <!-- Breadcrumb Start -->
    <BreadcrumbDefault :pageTitle="pageTitle"/>
    <!-- Breadcrumb End -->

    <div class="flex flex-col gap-10">
        <Products :products="products" :filters="filters"/>
    </div>
</template>
