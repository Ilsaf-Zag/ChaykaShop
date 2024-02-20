<script setup lang="ts">
import {ref, watch} from "vue";
import Pagination from "@components/Pagination/Pagination.vue";

import {router} from "@inertiajs/vue3";
import SearchInput from "@components/Forms/SearchInput.vue";

const props = defineProps(['products', 'filters']);
let search = ref(props.filters.search)
console.log(search)
const filters = (text,wordCount = 3) => {
    return text.split(' ').slice(0, wordCount).join(' ')
}

watch(search, (value) => {
    router.reload(
        {
            data:
                {
                    search: value
                },
        });
});

</script>

<template>
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="mb-2">
                    <SearchInput
                        v-model="search"
                    />
                </div>
                <div v-if="products.meta.total > 0"  class="shadow overflow-hidden border-b border-gray sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray bg-white dark:bg-boxdark">
                        <thead class="dark:bg-boxdark">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray dark:bg-boxdark uppercase tracking-wider">
                                Название продукта
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray uppercase tracking-wider">
                                Цена
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray uppercase tracking-wider">
                                Старая цена
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray uppercase tracking-wider">
                                Описание
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray uppercase tracking-wider">
                                Категория
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Действия</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray dark:bg-boxdark">
                        <tr v-for="product in products.data" :key="product.id">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ product.name }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                   {{product.price}}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ product.old_price}}
                                </div>
                            </td>
                            <td class="group px-6 py-4 whitespace-nowrap relative">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ filters(product.description)}}...
                                </div>
                                <textarea class="w-80 z-1 left-50 top-0 overflow-y-auto bg-black h-50 absolute hidden group-hover:block"> {{ product.description}}</textarea>

                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{product.category_id}}
                                </div>
                            </td>


                        </tr>
                        </tbody>
                    </table>

                    <Pagination :links="products.meta.links.label"/>
                </div>

                <div v-else class="text-center font-bold text-xl">
                    Продуктов пока нет
                </div>
            </div>
        </div>
    </div>
</template>
