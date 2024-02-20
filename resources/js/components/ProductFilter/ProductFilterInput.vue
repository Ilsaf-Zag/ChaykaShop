<template>
    <input
        :id="`filter-${section.id}-${optionIdx}`"
        :name="`${section.id}[]`"
        :value="option.id   "
        v-model="model"
        type="checkbox"
        :checked="option.checked"
        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"/>
    <label
        :for="`filter-mobile-${section.id}-${optionIdx}`"
        class="ml-3 min-w-0 flex-1 text-gray-500">
        {{
            option.label
        }}
    </label>

</template>

<script setup lang="ts">
import {defineModel, toRef} from "vue";


const props = defineProps(['section', 'optionIdx', 'option'])
const model = toRef(props.section.model)
</script>
