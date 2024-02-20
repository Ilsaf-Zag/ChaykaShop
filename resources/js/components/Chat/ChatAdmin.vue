<template>
    <div class="chat__content w-full flex flex-col">

        <h3 class="chat__title bg-red h-16">Онлайн поддержка</h3>
                <ChatMessages
                    v-model="chat"
                />
        <form @submit.prevent="sendMessage">
            <div class="chat__message-input flex h-16 ">
                    <textarea
                        v-model="form.text"
                        placeholder="Текст"
                        class="message-input__textarea w-full bg-black resize-none outline-none"></textarea>
                <button :disabled="form.processing" class="message-input__send">Отправить</button>
            </div>
        </form>
    </div>
</template>

<script setup lang="ts">
import {router, useForm, usePage} from "@inertiajs/vue3";
import ChatMessages from "./ChatMessages.vue";
import {computed, onBeforeMount, onBeforeUnmount} from 'vue'
import {ref} from "vue";


const chat = defineModel()
const form = useForm({
    text: ''
})

const page = usePage()
const scrollToElement = () => {
    const targetElement = document.querySelectorAll('.chat-message');
    const lastElement = targetElement[targetElement.length - 1]
    if (lastElement) {
        lastElement.scrollIntoView({
            behavior: 'smooth'
        });
    }
}

const sendMessage = () => {

    form.transform((data) => ({
        ...data,
        chat_id: chat.value?.chat_id
    }))
        .post(route('messages.store'), {
            onFinish() {
                form.text = ''
                scrollToElement()
            },
        })
}


Echo.private(`chat.${chat.value.chat_id}`)

    .listen('.message.sent', (res) => {

        chat.value.chat_id = res.message.chat_id
        chat.value.messages.push({
            visitor: res.message.visitor,
            message: res.message.message,
        })

        setTimeout(()=>{
            scrollToElement()
        })
    })

</script>
