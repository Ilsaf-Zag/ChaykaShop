<script setup lang="ts">
import Slider from "../Slider/Slider.vue";
import SliderInfo from "../Slider/SliderInfo.vue";


defineProps(['product','sizes'])

</script>

<style scoped>
.active {
    background-color: green;
}

</style>


<template>
<!--    <Breadcrumbs :items="myItems"/>-->

    <section class="product flex py-20">
        <Slider :product="product"/>
        <SliderInfo :sizes="sizes"/>
    </section>
</template>
