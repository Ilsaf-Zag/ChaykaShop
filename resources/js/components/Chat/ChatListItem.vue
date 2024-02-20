<script setup lang="ts">
import {Link} from "@inertiajs/vue3";

defineProps(['chat'])

</script>

<template>
    <Link
        :href="route('admin.chats.show',chat.id)"
        class="flex items-center gap-5 py-3 px-7.5 hover:bg-gray-3 dark:hover:bg-meta-4"
    >
        <div class="relative h-14 w-14 rounded-full">
<!--            <img :src="`https://ui-avatars.com/api/?name=${$page.props.user.name}&rounded=true&background=0D8ABC&color=fff`" alt="User" />-->
            <span
                class="absolute right-0 bottom-0 h-3.5 w-3.5 rounded-full border-2 border-white"
                :style="{ backgroundColor: '#10B981' }"
            ></span>
        </div>

        <div class="flex flex-1  items-center justify-between">
            <div>
                <h5 class="font-medium text-black dark:text-white">Пользователь №{{chat.id}}</h5>
                <p>
                    <span class="text-sm text-black dark:text-white">{{ chat.text }}</span>
                    <span class="text-xs"> . {{ chat.time }} </span>
                </p>
            </div>
            <div
                v-if="chat.messageCount !== 0"
                class="flex h-6 w-6 items-center justify-center rounded-full bg-primary"
            >
                              <span class="text-sm font-medium text-white"> {{ chat.textCount }}</span>
                <span class="text-sm font-medium text-white"> 1</span>
            </div>
        </div>
    </Link>
</template>
