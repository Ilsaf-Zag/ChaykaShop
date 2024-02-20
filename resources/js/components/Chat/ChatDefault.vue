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
import {computed, onMounted} from 'vue'
import {ref} from "vue";
import axios from "axios";

const chat = ref({
    chat_id: null,
    messages: []

})

const form = useForm({
    text: ''
})

onMounted(() => {
    getChat()
});
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
            onSuccess(){
                form.text = ''
                scrollToElement()

                if (chat.value.chat_id === null) {
                    getChat()
                }
            }
        })
}

const listenMessageSent  = () => {
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
}

const getChat = () => {
    axios.get(route('chats.index')).then(res => {
        if (res.data){
            chat.value.chat_id = res.data.chat_id
            chat.value.messages = res.data.messages

            listenMessageSent()
        }
    })
}



// if (chat.value.chat_id){
//     alert(chat.value.chat_id)
//
// }


// Echo.private(`chat.${chat.value.chat_id}`)
//
//     .listen('.message.sent', (res) => {
//
//         chat.value.chat_id = res.message.chat_id
//         chat.value.messages.push({
//             visitor: res.message.visitor,
//             message: res.message.message,
//         })
//
//
//     })
//     .whisper('typing', {
//         name: 'ivan1'
//     })
//     .listenForWhisper('typing', (e) => {
//         console.log(e.name);
//     });
</script>
