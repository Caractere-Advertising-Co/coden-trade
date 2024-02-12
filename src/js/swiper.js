const swiper = new Swiper(".swiper-hero", {
  loop: true,
  autoplay: false,
  cssMode: true,

  pagination: {
    el: ".swiper-pagination",
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
});

const swiperResp = new Swiper(".swiper-resp", {
  loop: true,
  autoplay: false,
  slidesPerGroup: 1,
  centeredSlides: false,
  cssMode: true,
  slidesPerView: 1.3,
  spaceBetween: 30,
});

const swiperRespNos = new Swiper(".swiper-nos", {
  loop: true,
  autoplay: false,
  slidesPerGroup: 1,
  centeredSlides: false,
  cssMode: true,
  slidesPerView: 1.3,
  spaceBetween: 30,
});
