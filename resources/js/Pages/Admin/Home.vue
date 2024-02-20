<script setup lang="ts">
import { ref } from 'vue'
import BreadcrumbDefault from '@components/Breadcrumbs/BreadcrumbDefault.vue'
import AdminLayout from '@layouts/AdminLayout.vue'
import ChatList from "@components/Chat/ChatList.vue";

const pageTitle = ref('Управление')

defineOptions({ layout: AdminLayout })
</script>

<template>
        <!-- Breadcrumb Start -->
        <BreadcrumbDefault :pageTitle="pageTitle"/>
        <!-- Breadcrumb End -->

</template>
