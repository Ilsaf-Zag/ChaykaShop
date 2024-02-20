<template>
    <div>
        <div>
            <!-- Mobile filter dialog -->
            <TransitionRoot as="template" :show="mobileFiltersOpen">
                <Dialog as="div" class="relative z-40 lg:hidden" @close="mobileFiltersOpen = false">
                    <TransitionChild as="template" enter="transition-opacity ease-linear duration-300"
                                     enter-from="opacity-0" enter-to="opacity-100"
                                     leave="transition-opacity ease-linear duration-300" leave-from="opacity-100"
                                     leave-to="opacity-0">
                        <div class="fixed inset-0 bg-black bg-opacity-25"/>
                    </TransitionChild>

                    <div class="fixed inset-0 z-40 flex">
                        <TransitionChild as="template" enter="transition ease-in-out duration-300 transform"
                                         enter-from="translate-x-full" enter-to="translate-x-0"
                                         leave="transition ease-in-out duration-300 transform"
                                         leave-from="translate-x-0" leave-to="translate-x-full">
                            <DialogPanel
                                class="relative ml-auto flex h-full w-full max-w-xs flex-col overflow-y-auto py-4 pb-12 shadow-xl mt-20 bg-white dark:bg-boxdark">
                                <div class="flex items-center justify-between px-4">
                                    <h2 class="text-lg font-medium text-gray-900">Фильтры</h2>
                                    <button type="button"
                                            class="-mr-2 flex h-10 w-10 items-center justify-center rounded-md  p-2 text-gray-400"
                                            @click="mobileFiltersOpen = false">
                                        <span class="sr-only">Close menu</span>
                                        <XMarkIcon class="h-6 w-6" aria-hidden="true"/>
                                    </button>
                                </div>

                                <!-- Filters -->
                                <form class="mt-4 border-t border-gray-200">

                                    <Disclosure as="div" v-for="section in filters" :key="section.id"
                                                class="border-t border-gray-200 px-4 py-6" v-slot="{ open }">
                                        <h3 class="-mx-2 -my-3 flow-root">
                                            <DisclosureButton
                                                class="flex w-full items-center justify-between px-2 py-3 text-gray-400 hover:text-gray-500">
                                                <span class="font-medium text-gray-900">{{ section.name }}</span>
                                                <span class="ml-6 flex items-center">
                          <PlusIcon v-if="!open" class="h-5 w-5" aria-hidden="true"/>
                          <MinusIcon v-else class="h-5 w-5" aria-hidden="true"/>
                        </span>
                                            </DisclosureButton>
                                        </h3>
                                        <DisclosurePanel class="pt-6">
                                            <div class="space-y-6">
                                                <div v-for="(option, optionIdx) in section.options" :key="option.value"
                                                     class="flex items-center">

                                                    <ProductFilterInput
                                                        :section="section"
                                                        :option="option"
                                                        :optionIdx="optionIdx"
                                                    />
                                                </div>
                                            </div>
                                        </DisclosurePanel>
                                    </Disclosure>
                                </form>
                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </Dialog>
            </TransitionRoot>

            <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex items-baseline justify-between border-b border-gray-200 pb-6 pt-24">
                    <h1 class="text-4xl font-bold tracking-tight text-gray-900">Каталог</h1>

                    <div class="flex items-center">
                        <Menu as="div" class="relative inline-block text-left">
                            <transition enter-active-class="transition ease-out duration-100"
                                        enter-from-class="transform opacity-0 scale-95"
                                        enter-to-class="transform opacity-100 scale-100"
                                        leave-active-class="transition ease-in duration-75"
                                        leave-from-class="transform opacity-100 scale-100"
                                        leave-to-class="transform opacity-0 scale-95">
                            </transition>
                            <SelectMenu
                                v-model="sort"
                                :options="sortOptions"
                                >
                            </SelectMenu>
                        </Menu>

                        <button type="button" class="-m-2 ml-4 p-2 text-gray-400 hover:text-gray-500 sm:ml-6 lg:hidden"
                                @click="mobileFiltersOpen = true">
                            <span class="sr-only">Filters</span>
                            <FunnelIcon class="h-5 w-5" aria-hidden="true"/>
                        </button>
                    </div>
                </div>

                <section aria-labelledby="products-heading" class="pb-24 pt-2">
                    <h2 id="products-heading" class="sr-only">Товары</h2>

                    <div class="grid grid-cols-1 gap-x-8 gap-y-10 lg:grid-cols-4">
                        <!-- Filters -->
                        <form class="hidden lg:block">

                            <Disclosure as="div"
                                        v-for="section in filters"
                                        :key="section.id"
                                        class="border-b border-gray-200 py-6" v-slot="{ open }">
                                <h3 class="-my-3 flow-root">
                                    <DisclosureButton
                                        class="flex w-full items-center justify-between py-3 text-sm text-gray-400 hover:text-gray-500">
                                        <span class="font-medium text-gray-900">{{ section.name }}</span>
                                        <span class="ml-6 flex items-center">
                      <PlusIcon v-if="!open" class="h-5 w-5" aria-hidden="true"/>
                      <MinusIcon v-else class="h-5 w-5" aria-hidden="true"/>
                    </span>
                                    </DisclosureButton>
                                </h3>

                                <DisclosurePanel class="pt-6">
                                    <div class="space-y-4">
                                        <div v-for="(option, optionIdx) in section.options" :key="option.value"
                                             class="flex items-center">
                                            <ProductFilterInput
                                                :section="section"
                                                :option="option"
                                                :optionIdx="optionIdx"
                                            />
                                        </div>
                                    </div>
                                </DisclosurePanel>
                            </Disclosure>
                        </form>

                        <!-- Product grid -->
                        <div class="lg:col-span-3">
                            <slot/>
                        </div>
                    </div>
                </section>
            </main>
        </div>


    </div>
</template>

<script setup lang="ts">
import {defineComponent, defineModel, reactive, ref, toRef, watch} from 'vue'
import {
    Dialog,
    DialogPanel,
    Disclosure,
    DisclosureButton,
    DisclosurePanel,
    Menu,
    MenuButton,
    MenuItem,
    MenuItems,
    TransitionChild,
    TransitionRoot,
} from '@headlessui/vue'
import {XMarkIcon} from '@heroicons/vue/24/outline'
import {ChevronDownIcon, FunnelIcon, MinusIcon, PlusIcon, Squares2X2Icon} from '@heroicons/vue/24/solid'
import {router} from "@inertiajs/vue3"
import SelectMenu from "@components/Forms/SelectMenu.vue";
import ProductFilterInput from "./ProductFilterInput.vue";


const props = defineProps(['sizes', 'categories'])

const sizes = ref([])
const categories = ref([])
const sort = ref('latest')

watch([sizes,categories, sort], ([sizesValue,categoriesValue, sortValue]) => {
    router.get(route('home'), {
        sizes: sizesValue,
        categories:categoriesValue,
        sort: sortValue,
    },{
        preserveState: true
    })
})


const sortOptions = [
    {name: 'По новинкам', value: 'latest'},
    {name: 'По возрастанию цены', value: 'ascending'},
    {name: 'По убыванию цены', value: 'descending'},
]
const subCategories = [
    {name: 'Totes', href: '#'},

]

const filterValSubstutation = (objects) => {
    const filters = [];

    for (let object of objects) {
        let filter = {}

        filter.id = object.id;
        filter.name = object.name;
        filter.model = object.model
        let options = []

        for (let value of object.values) {
            options.push({
                id: value.id,
                value: value.name,
                label: value.name.charAt(0).toUpperCase() + value.name.slice(1)
            })
        }

        filter.options = options;
        filters.push(filter);
    }

    return filters;
}

const filterOptions = [
    {
        id: 'size',
        name: 'Размер',
        model: sizes,
        values: props.sizes,
    },
    {
        id: 'category',
        name: 'Категория',
        model: categories,
        values: props.categories,
    },
]

const filters = filterValSubstutation(filterOptions);
const mobileFiltersOpen = ref(false)
/*export default defineComponent({
    data(){
        return {
            categories:[],
            sizes:[],
            selected:{
                categories: [],
                sizes:[],

            }
        }
    },
    mounted() {
        this.loadCategories();
        this.loadSizes();
    },
    watch:{
        selected:{
            handler(){
                this.loadCategories();
                this.loadSizes();
            },
            deep:true
        }
    },

    methods:{
        loadCategories(){
            router.get('/')
        },
        loadSizes(){

        }
    }
})*/
</script>
<!--<script lang="ts">-->
<!--import {router} from "@inertiajs/vue3";-->

<!--export default {-->
<!--    data(){-->
<!--        return{-->
<!--            categories:[],-->
<!--            sizes:[],-->
<!--            selected:{-->
<!--                categories:[],-->
<!--                sizes:[],-->
<!--            }-->
<!--        }-->
<!--    },-->

<!--    mounted() {-->
<!--        this.loadCategories()-->
<!--        this.loadSizes()-->
<!--    },-->

<!--    methods:{-->
<!--        loadCategories(){-->
<!--            router.get('/')-->
<!--        },-->

<!--        loadSizes(){-->

<!--        }-->
<!--    }-->
<!--}-->
<!--</script>-->

