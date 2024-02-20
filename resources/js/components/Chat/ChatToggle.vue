<template>

    <div id="trigger-chat">
        <button @click="show = true"
                class="flex items-center justify-center bg-violet-400 cursor-pointer fixed w-14 h-14 bg-violet-600 bottom-8 left-8 rounded-full">
            <ChatBubbleOvalLeftEllipsisIcon class="h-6 w-6" aria-hidden="true"/>
        </button>

        <div v-show="show" class="chat fixed bottom-8 left-8">

            <slot />

            <button @click="show = false" class="absolute right-5 top-5">
                <XMarkIcon class="h-6 w-6" aria-hidden="true"/>
            </button>
        </div>



    </div>
</template>

<script setup lang="ts">
import {onMounted, ref} from "vue";
import {XMarkIcon, ChatBubbleOvalLeftEllipsisIcon} from '@heroicons/vue/24/outline'
import {router, useForm} from "@inertiajs/vue3";

const props = defineProps(['messages'])


const show = ref(false);

const form = useForm({
    text: ''
})

const sendMessage = () => {
    form.post(route('messages.store'), {
        onFinish: () => {
            form.text = ''
        }
    })
}
</script>
