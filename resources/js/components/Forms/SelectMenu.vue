<script setup lang="ts">
import {defineModel, ref} from 'vue'

const isOptionSelected = ref<boolean>(false)
const props = defineProps(['options'])
const model = defineModel()
const changeTextColor = () => {
    isOptionSelected.value = true
}
import {ChevronDownIcon} from "@heroicons/vue/24/outline";

</script>

<template>

     <div class="w-60 relative bg-transparent dark:bg-form-input">
        <select
            v-model="model"
            class="cursor-pointer relative w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
            :class="{ 'text-black dark:text-white': isOptionSelected }"
            @change="changeTextColor"
        >
            <option
                v-for="option in props.options"
                :value="option.value"
                :key="option.value"


            >
                {{ option.name }}
            </option>
        </select>


        <span class="absolute pointer-events-none top-1/2 right-4 -translate-y-1/2">
                 <ChevronDownIcon
                     class="w-8 h-8"
                 />
      </span>
    </div>
</template>
