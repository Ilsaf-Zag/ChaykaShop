<template>
        <div class="mt-8 space-y-8 lg:mt-2">
            <div class="p-8 bg-gray-100 rounded-lg dark:bg-gray-800">
                <button @click="open = !open" class="flex items-center justify-between w-full">
                    <h2 class="font-semibold text-gray-700 dark:text-white">{{faq.title}}</h2>

                    <PlusCircleIcon v-show="!open" class="h-8"/>
                    <MinusCircleIcon v-show="open" class="h-8"/>
                </button>

                <p v-show="open" class="mt-6 text-sm text-gray-500 dark:text-gray-300">
                    {{faq.text}}
                </p>
            </div>
        </div>

</template>

<script setup lang="ts">
import {ref} from "vue";
import { PlusCircleIcon,MinusCircleIcon } from '@heroicons/vue/24/outline'

defineProps({
    faq:Object
})

const open = ref(false)



</script>


<style scoped>

</style>
