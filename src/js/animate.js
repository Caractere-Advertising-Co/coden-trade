import inView from "in-view";
import gsap from "gsap";

$(document).ready(function () {
  //IN-VIEW
  if (document.querySelector(".from-left")) {
    document.querySelector(".from-left").classList.add("invisible");
  }
  if (document.querySelector(".from-right")) {
    document.querySelector(".from-right").classList.add("invisible");
  }
  if (document.querySelector(".from-top")) {
    document.querySelector(".from-top").classList.add("invisible");
  }
  if (document.querySelector(".from-bottom")) {
    document.querySelector(".from-bottom").classList.add("invisible");
  }

  function makeMagic(data, direction) {
    data.classList.remove("invisible");
    data.classList.add(direction);
  }

  function removeMagic(data, direction) {
    data.classList.add("invisible");
    data.classList.add(direction);
  }

  inView.offset(150);

  inView(".from-left").on("enter", (el) => {
    makeMagic(el, "fade-in-left");
  });

  inView(".from-right").on("enter", (el) => {
    makeMagic(el, "fade-in-right");
  });

  inView(".from-bottom").on("enter", (el) => {
    makeMagic(el, "fade-in-bottom");
  });

  inView(".from-top").on("enter", (el) => {
    makeMagic(el, "fade-in-top");
  });

  /* ANIMATION NUMBER */
  const counters = document.querySelectorAll(".animate-number");
  const speed = 100;

  inView(".grid_stats").on("enter", (e) => {
    counters.forEach((counter) => {
      const animate = () => {
        const value = +counter.dataset.number;
        const data = +counter.innerText;

        const time = value / speed;
        if (data < value) {
          counter.innerText = Math.ceil(data + time);

          if (value < 100) {
            setTimeout(animate, 40);
          } else {
            setTimeout(animate, 2);
          }
        } else {
          counter.innerTexte = value;
        }
      };

      animate();
    });
  });

  // Outline

  // Sélection de tous les éléments avec la classe .outline
  const menu = document.querySelectorAll(".outline");

  // Parcours de chaque élément .outline
  menu.forEach(function (el) {
    el.addEventListener("click", function () {
      // Supprimer la classe .active de tous les éléments .outline
      menu.forEach(function (item) {
        item.classList.remove("active");
      });

      // Ajouter la classe .active à l'élément actuellement cliqué
      el.classList.add("active");

      const panelId = el.id.replace("cat-", "");
      const panels = document.querySelectorAll(".cold .panel");

      panels.forEach(function (panel) {
        panel.style.display = "none";
      });

      // Afficher le panneau correspondant
      const activePanel = document.querySelector(
        ".cold .panel.panel" + panelId
      );
      if (activePanel) {
        activePanel.style.display = "block";
      }
    });
  });
});
