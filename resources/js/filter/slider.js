import Swiper from 'swiper';
import {Controller} from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

export async function initSlider() {
    const slider = new Swiper ('.gallery-slider', {
        slidesPerView: 1,
        centeredSlides: true,
        modules: [Controller],
    });

    const thumbs = new Swiper ('.gallery-thumbs', {
        slidesPerView: 6,
        modules: [Controller],
        spaceBetween: 30,
        centeredSlides: true,
        slideToClickedSlide: true,
    });

    slider.controller.control = thumbs;
    thumbs.controller.control = slider;
}
