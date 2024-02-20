<template>
    <div class="chat__messages bg-green-300 h-60 overflow-y-auto scrollbar" >
        <div class="w-full px-5 flex flex-col justify-between">
            <div class="flex flex-col mt-5">
                <div v-if="chat">
                    <div
                        v-for="message in chat.messages"
                        :key="message.id"
                       class="chat-message"
                    >
                        <div v-if="$page.props.user">
                            <div
                                class="flex mb-4"
                                :class="message.visitor ?

                                 'justify-start':
                                 'justify-end'
                                "
                            >

                                <div
                                    class="py-3 px-4 text-white"
                                    :class="message.visitor ?

                                    'ml-2 py-3 px-4 bg-black rounded-br-3xl rounded-tr-3xl rounded-tl-xl':
                                         'mr-2 bg-blue-400 rounded-bl-3xl rounded-tl-3xl rounded-tr-xl'
                                     "
                                >
                                    {{ message.message }}
                                </div>
                            </div>
                        </div>

                        <div v-else>
                            <div
                                class="flex mb-4"
                                :class="message.visitor ?
                                'justify-end':
                                'justify-start'
                                ">

                                <div
                                    class="py-3 px-4 text-white"
                                    :class="message.visitor ?
                                    'mr-2 bg-blue-400 rounded-bl-3xl rounded-tl-3xl rounded-tr-xl':
                                    'ml-2 py-3 px-4 bg-black rounded-br-3xl rounded-tr-3xl rounded-tl-xl'
                                     "
                                >
                                    {{ message.message }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import {router, useForm} from "@inertiajs/vue3";
import {computed} from "vue";

const chat = defineModel()

</script>
