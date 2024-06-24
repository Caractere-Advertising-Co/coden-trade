const swiper = new Swiper(".swiper-hero", {
  loop: true,
  autoplay: {
    delay: 5000,
    disableOnIntercation: true,
  },
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
  breakpoints: {
    320: {
      slidesPerView: 1.2,
      spaceBetween: 20
    },
    // when window width is >= 640px
    640: {
      slidesPerView: 1.2,
      spaceBetween: 20
    },
    1024: {
      slidesPerView: 3,
      spaceBetween: 30,
    } 
  },

  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
});

const swiperService = new Swiper(".swiper-service",{
  cssMode : true,
  loop: true,
  navigation : {
    nextEl: ".swiper-next-about",
    prevEl: ".swiper-prev-about",
  }
})

const swiperAbout = new Swiper(".swiper-about", {
  cssMode: true,
  loop: true,
  slidesPerView: 1,

  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
});

const swiperBlog = new Swiper(".swiper-blog", {
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
