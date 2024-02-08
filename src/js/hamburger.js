var hamburger = document.querySelector(".hamburger-menu");
var menu = document.querySelector(".megamenu");

hamburger.addEventListener("click", function () {
  menu.classList.toggle("active");
});
