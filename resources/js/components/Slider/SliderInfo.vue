<template>
    <div class="product__info flex flex-col">
        <h2>Футболка</h2>
        <div>2500 р.</div>
        <p>Размер</p>
        <form action="">
            <div class="flex mt-5">
                <div class="p-1" v-for="item in items">
                    <label @click="item.active = !item.active"
                           class="p-2 border-2 select-none cursor-pointer bg-violet-400 hover:bg-violet-600 duration-300 "
                           :class="{ active: item.active }"
                           :for="`size-${item.size}`">{{ item.size }}</label>
                    <input class="invisible opacity-0 absolute left"
                           type="checkbox"
                           :id="`size-${item.size}`"
                           name="size[]">
                </div>
            </div>

            <input type="submit" class="btn " value="Купить">
        </form>


        <div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A, debitis dignissimos rem repellat rerum
            sed.
        </div>
    </div>
</template>

<script>
export default {
    name: "SliderInfo"
}
</script>

<style scoped>

</style>
