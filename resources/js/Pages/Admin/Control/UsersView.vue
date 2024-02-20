<script setup lang="ts">
import { ref } from 'vue'
import BreadcrumbDefault from '@components/Breadcrumbs/BreadcrumbDefault.vue'
import Users from '@components/Control/Users.vue'
import AdminLayout from '@layouts/AdminLayout.vue'

const pageTitle = ref('Управление')

defineOptions({ layout: AdminLayout })
defineProps({
    users: {
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
            <Users :users="users" :filters="filters" />
        </div>
</template>
