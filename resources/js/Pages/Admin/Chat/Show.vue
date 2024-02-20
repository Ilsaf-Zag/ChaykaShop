<script setup lang="ts">
import {ref} from 'vue'
import BreadcrumbDefault from '@components/Breadcrumbs/BreadcrumbDefault.vue'
import AdminLayout from '@layouts/AdminLayout.vue'
import ChatAdmin from "@components/Chat/ChatAdmin.vue";

const pageTitle = ref('Управление')

defineOptions({layout: AdminLayout})
const props = defineProps({
    chat:Object
})

const chat = ref(props.chat)

</script>

<template>
    <!-- Breadcrumb Start -->
    <BreadcrumbDefault :pageTitle="pageTitle"/>
    <!-- Breadcrumb End -->

    <div class="flex flex-col gap-10">
       <ChatAdmin
           v-model="chat"
       />
    </div>
</template>
