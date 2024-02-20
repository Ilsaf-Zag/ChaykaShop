<template>
    <button @click="back">
        <slot></slot>
    </button>
</template>


<script>
import {router} from "@inertiajs/vue3";

export default {
    name: "Back",
    props:{
        routeName:{
            type:String,
            default:'/'
        }
    },
    setup(props){
        function back() {
            window.history.back() || router(route(props.routeName))
        }
        return {back}
    }
}
</script>

<style scoped>

</style>
