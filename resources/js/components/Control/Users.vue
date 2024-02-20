<script setup lang="ts">
import {defineComponent, ref, watch,defineModel} from "vue";
import Pagination from "@components/Pagination/Pagination.vue";
import {Link, router} from "@inertiajs/vue3";
import SearchInput from "../Forms/SearchInput.vue";

const props = defineProps(['users', 'filters']);

let search = ref(props.filters.search)

watch(search, (value) => {
    router.reload(
        {
            data:
                {
                    search: value
                },
            only: ['users']
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
                <div v-if="props.users.total > 0" class="shadow overflow-hidden border-b border-gray sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray">
                        <thead class="dark:bg-boxdark">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray uppercase tracking-wider">
                                Имя
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray uppercase tracking-wider">
                                E-mail
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Действия</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray dark:bg-boxdark">
                        <tr v-for="user in users.data" :key="user.id">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ user.name }}
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ user.email }}
                                </div>
                            </td>


                        </tr>
                        </tbody>
                    </table>

                    <Pagination :links="users.links"/>
                </div>

                <div v-else class="text-center font-bold text-xl">
                    Пользователей пока нет
                </div>
            </div>
        </div>
    </div>
</template>

