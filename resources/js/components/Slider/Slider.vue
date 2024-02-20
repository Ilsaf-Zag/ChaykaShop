<template>
        <div class="slider">

            <div
                    id="thumbnail-carousel"
                    class="splide"
                    aria-label="The carousel with thumbnails. Selecting a thumbnail will change the Beautiful Gallery carousel."
            >

                <div class="splide__track">
                    <ul class="splide__list splide__secondary">
                        <li class="splide__slide">
                            <img src="@assets/images/carousel/carousel-01.jpg" alt="">
                        </li>
                        <li class="splide__slide">
                            <img src="@assets/images/carousel/carousel-02.jpg" alt="">
                        </li>
                        <li class="splide__slide">
                            <img src="@assets/images/carousel/carousel-03.jpg" alt="">
                        </li>
                    </ul>
                </div>
            </div>
            <div id="main-carousel" class="splide">

                <div class="splide__track">
                    <ul class="splide__list">
                        <li class="splide__slide">
                            <img src="@assets/images/carousel/carousel-01.jpg" alt="">
                        </li>
                        <li class="splide__slide">
                            <img src="@assets/images/carousel/carousel-02.jpg" alt="">
                        </li>
                        <li class="splide__slide">
                            <img src="@assets/images/carousel/carousel-03.jpg" alt="">
                        </li>

                    </ul>
                </div>

            </div>
        </div>
</template>

<script>


import Splide from '@splidejs/splide';
import '@splidejs/splide/css';


export default {
    name: "Slider",

    mounted() {
        this.slider();

    },
    methods: {
        slider() {
            const main = new Splide('#main-carousel', {
                type   : 'fade',
                perPage: 1,
                width:450,
                height:"calc(100vh - 20%)",

                rewind: true,
                pagination: false,
                arrows: true,
            });
            const thumbnails = new Splide('#thumbnail-carousel', {

                gap: 10,
                rewind: true,
                height:200,
                pagination: false,
                isNavigation: true,
                arrows: false,
                breakpoints: {
                    600: {
                        fixedWidth: 60,
                    },
                },

            });
            main.sync(thumbnails);
            main.mount();
            thumbnails.mount();

        },

    }

}
</script>

<style>
.splide__slide img {
}

.splide__slide {
    opacity: 0.6;
}

.splide__slide.is-active {
    opacity: 1;
}
.slider{
display: flex;

}
.splide__secondary{
    display: flex;
    flex-direction: column;
}
.splide__slide img {
    transform-origin: center center;
    object-fit: cover;
    height: 100%;
    width: 100%;
}
#main-carousel{
    overflow: hidden;
    display: flex;
    align-items: center;
}
#thumbnail-carousel{
    overflow: hidden;
}
</style>
