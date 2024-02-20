<script setup lang="ts">
import {ref} from 'vue'
import Catalog from "@components/Catalog/Catalog.vue";
import ChoppingCartMini from "@components/ChoppingCart/ChoppingCartMini.vue";
import ProductFilter from "@components/ProductFilter/ProductFilter.vue";
import Chat from "@components/Chat/ChatDefault.vue";

defineProps({
    products: Object,
    sizes: Object,
    categories: Object,
    cartProducts: Object,
    cartTotal: Object,
})

const pageTitle = ref('Главная')

</script>
<style>

</style>


<template>
    <ChoppingCartMini :cartProducts="cartProducts" :cartTotal="cartTotal" />
    <ProductFilter :sizes="sizes" :categories="categories">
        <Catalog :products="products"/>
    </ProductFilter>
</template>
