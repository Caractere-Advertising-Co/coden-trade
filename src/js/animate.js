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

    // Arrêter le défilement automatique lorsqu'un élément est cliqué
    clearInterval(sliderInterval);
  });
});

// Défilement automatique des éléments du menu
let currentIndex = 0;
const sliderInterval = setInterval(() => {
  // Supprimer la classe .active de l'élément actuel
  menu[currentIndex].classList.remove("active");
  const nextIndex = (currentIndex + 1) % menu.length;
  // Ajouter la classe .active à l'élément suivant
  menu[nextIndex].classList.add("active");

  // Afficher le panneau correspondant
  const panelId = menu[nextIndex].id.replace("cat-", "");
  const panels = document.querySelectorAll(".cold .panel");
  panels.forEach(function (panel) {
    panel.style.display = "none";
  });
  const activePanel = document.querySelector(
    ".cold .panel.panel" + panelId
  );
  if (activePanel) {
    activePanel.style.display = "block";
  }

  currentIndex = nextIndex;
}, 3000); // Définir l'intervalle de temps en millisecondes (par exemple, 5000 pour 5 secondes)


  /* Text banner*/
  
  let containerBanner = document.querySelector('.variable-text');
  let wordsBanner, singleWord, z, timeoutBanner;
    
  if (document.querySelector('#wordsBanner')) {
    wordsBanner = document.querySelector('#wordsBanner').getAttribute('data-changed').split(',');
  }

  if (containerBanner) {
    let messageBanner = containerBanner.innerHTML;
    singleWord = '';
    z = -1;
    
    let modeBanner = 'write';
    let delayBanner = 1000;

    function updateTextBanner(txt) {
      containerBanner.innerHTML = txt;
    }

    function tickBanner() {
      if(containerBanner.innerHTML.length == 0) {
        if(z === (wordsBanner.length - 1)){
          z = -1;
        }

        z++;
        singleWord = wordsBanner[z];
        messageBanner = '';
        modeBanner = 'write';
      }

      switch(modeBanner) {
        case 'write' :
          messageBanner += singleWord.slice(0, 1);
          singleWord = singleWord.substr(1);

          updateTextBanner(messageBanner);

          if(singleWord.length == 0){
            modeBanner = 'delete';
            delayBanner = 1500;
          } else {
            delayBanner = 32 + Math.round(Math.random() * 40);
          }

          break;

        case 'delete' :
          messageBanner = messageBanner.slice(0, -1);
                
          updateTextBanner(messageBanner);

          if(messageBanner.length == 0){
            modeBanner = 'write';
            delayBanner = 1500;
          } else {
            delayBanner = 32 + Math.round(Math.random() * 100);
          }
          
          break;
        }

      timeoutBanner = window.setTimeout(tickBanner, delayBanner);
    }
      timeoutBanner = window.setTimeout(tickBanner, delayBanner);
    }
});
