<template >
    <TransitionRoot as="template" :show="open" >
        <Dialog as="div" class="relative z-10" @close="open = false">
            <TransitionChild as="template" enter="ease-in-out duration-500" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in-out duration-500" leave-from="opacity-100" leave-to="opacity-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
            </TransitionChild>

            <div class="fixed inset-0 overflow-hidden">
                <div class="absolute inset-0 overflow-hidden">
                    <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
                        <TransitionChild as="template" enter="transform transition ease-in-out duration-500 sm:duration-700" enter-from="translate-x-full" enter-to="translate-x-0" leave="transform transition ease-in-out duration-500 sm:duration-700" leave-from="translate-x-0" leave-to="translate-x-full">
                            <DialogPanel class="pointer-events-auto w-screen max-w-md">
                                <div class="flex mt-[70px] h-[calc(100%-70px)] flex-col overflow-y-scroll bg-white dark:bg-boxdark shadow-xl">
                                    <div class="flex-1 overflow-y-auto px-4 py-6 sm:px-6">
                                        <div class="flex items-start justify-between">
                                            <DialogTitle class="text-lg font-medium text-gray-900">Корзина</DialogTitle>
                                            <div class="ml-3 flex h-7 items-center">
                                                <button type="button" class="relative -m-2 p-2 text-gray-400 hover:text-gray-500" @click="open = false">
                                                    <span class="absolute -inset-0.5" />
                                                    <span class="sr-only">Close panel</span>

                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                                    </svg>



                                                </button>
                                            </div>
                                        </div>

                                        <div class="mt-8">
                                            <div class="flow-root">
                                                <ul role="list" class="-my-6 divide-y divide-gray-200">
                                                    <li v-for="product in cartProducts" :key="product.id" class="flex py-6">
                                                        <div class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
                                                            <img src='https://tailwindui.com/img/ecommerce-images/shopping-cart-page-04-product-01.jpg'  class="h-full w-full object-cover object-center" />
                                                        </div>

                                                        <div class="ml-4 flex flex-1 flex-col">
                                                            <div>
                                                                <div class="flex justify-between text-base font-medium text-gray-900">
                                                                    <h3 class="max-w-44">
                                                                        <Link :href="route('products.show',product.product_slug)">{{ product.name }}</Link>
                                                                    </h3>
                                                                    <p class="ml-4">{{ product.price }} ₽</p>
                                                                </div>
                                                            </div>
                                                            <div class="flex flex-1 items-end justify-between text-sm">
                                                                <p class="text-gray-500">Количество: {{ product.quantity }}</p>

                                                                <div class="flex">
                                                                    <button :disabled="disabled" @click="removeProduct(product.id)" type="button" class="font-medium text-indigo-600 hover:text-indigo-500">Remove</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="border-t border-gray-200 px-4 py-6 sm:px-6">
                                        <div class="flex justify-between text-base font-medium text-gray-900">
                                            <p>Сумма</p>
                                            <p>{{cartTotal}} рублей</p>
                                        </div>
                                        <p class="mt-0.5 opacity-25 text-sm text-gray-500">Доставка рассчитываются при оформлении заказа.</p>
                                        <div class="mt-6">
                                            <a href="#" class="flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700">Перейти к оплате</a>
                                        </div>

                                    </div>
                                </div>
                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>

    <button @click="open = true" class="flex fixed right-10 bottom-10">
        <ShoppingBagIcon class="h-10" aria-hidden="true"/>
    </button>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { ShoppingBagIcon } from "@heroicons/vue/24/outline"
import {Link, router} from "@inertiajs/vue3";



const props = defineProps(['cartProducts','cartTotal']);

const removeProduct = (id) => {

    router.delete(route('cart.destroy',id),{
        onBefore(){
            disabled.value = true
        },
        onFinish(){
            disabled.value = false
        }
    })

}

const open = ref(false)
const disabled = ref(false)
</script>
