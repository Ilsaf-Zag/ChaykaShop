<script setup lang="ts">

import ChatListItem from "./ChatListItem.vue";
import {router} from "@inertiajs/vue3";
import {onBeforeUnmount, ref, watch} from "vue";
import SearchInput from "../Forms/SearchInput.vue";
import Pagination from "../Pagination/Pagination.vue";


const props = defineProps(['chats','filters'])
const search = ref(props.filters.search)

Echo.channel('chats')
    .listen('.message.sent', () => {
        router.reload()
    });

onBeforeUnmount(()=>{
    Echo.leaveChannel(`chats`);
})


console.log(props.filters)
watch(search, (value) => {
    router.reload(
        {
            data:
                {
                    search: value
                },
            only: ['chats']
        });
});

</script>

<template>
    <SearchInput v-model="search" />

    <div
        class="col-span-12 rounded-sm border border-stroke bg-white py-6 shadow-default dark:border-strokedark dark:bg-boxdark xl:col-span-4"
    >
        <h4 class="mb-6 px-7.5 text-xl font-semibold text-black dark:text-white">Chats</h4>
        <ChatListItem
            v-for="(chat, index) in chats.data" :key="index"
            :chat="chat"
        />
    </div>

    <Pagination :links="chats.meta.links"/>
</template>
