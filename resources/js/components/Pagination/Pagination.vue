<template>
    <div v-if="links" class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6 dark:bg-boxdark">
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">

                    <Link
                        v-for="(link,i) in links" :key="i"
                        v-html="link.label"
                        class="border-gray text-gray hover:bg-black relative inline-flex items-center px-4 py-2 border text-sm font-medium"
                        :disabled="link.url === null"
                        :class="{'text-blue-500 font-bold':link.active,'bg-graydark': link.url === null }"
                        :href="link.url"
                    >
                    </Link>
                </nav>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import {Link} from '@inertiajs/vue3'
const props = defineProps(['links'])
</script>
