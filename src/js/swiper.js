const swiper = new Swiper(".swiper", {
  loop: false,
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
