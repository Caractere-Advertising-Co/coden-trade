const swiper = new Swiper(".swiper-hero", {
  loop: true,
  autoplay: false,
  cssMode: true,

  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
});

const swiperFrontPage = new Swiper(".swiper-resp", {
  cssMode: true,
  loop: true,
  slidesPerView: 3,
  spaceBetween: 30,

  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
});

const swiperAbout = new Swiper(".swiper-about", {
  cssMode: true,
  loop: true,
  slidesPerView: 1,

  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
});

/* WOOCOMMERCE */

const swipThumbs = new Swiper(".swiper-thumbs", {
  spaceBetween: 15,
  slidesPerView: 3,
  freeMode: true,
  watchSlidesProgress: true,
});

const swipProduct = new Swiper(".swiper-product", {
  cssMode: true,
  thumbs: {
    swiper: swipThumbs,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
});
