var hamburger = document.querySelector(".hamburger-menu");
var menu = document.querySelector(".megamenu");
var header = document.querySelector(".navigation");

hamburger.addEventListener("click", function () {
  menu.classList.toggle("active");
  header.classList.toggle("active");
  header.classList.toggle("fixed");
});
