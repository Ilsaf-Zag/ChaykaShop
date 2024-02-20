<script setup lang="ts">
import {ref} from 'vue'
import BreadcrumbDefault from '@components/Breadcrumbs/BreadcrumbDefault.vue'
import AdminLayout from '@layouts/AdminLayout.vue'
import ChatList from "@components/Chat/ChatList.vue";
import SearchInput from "../../../components/Forms/SearchInput.vue";


const pageTitle = ref('Управление')

defineOptions({layout: AdminLayout})

const props = defineProps({
    chats:Object,
    filters:String
})

</script>

<template>
    <!-- Breadcrumb Start -->
    <BreadcrumbDefault :pageTitle="pageTitle"/>
    <!-- Breadcrumb End -->


    <div class="flex flex-col gap-10">
       <ChatList :chats="chats" :filters="filters"/>
    </div>
</template>
