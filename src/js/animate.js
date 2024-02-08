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
        const value = +counter.data("number");
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
          if (value > 1000) {
            counter.innerText = value / 1000 + " K";
          } else {
            counter.innerTexte = value;
          }
        }
      };

      animate();
    });
  });

  // inView(".animate-number").on("enter", function (element) {

  //   gsap
  //     .from(element.querySelector("h3"), {
  //       textContent: 0,
  //       duration: 4, // Ajuste la durée de l'animation
  //       ease: "power4.easeIn",
  //       onUpdate: function () {
  //         this.targets()[0].innerHTML = Math.round(
  //           this.targets()[0].textContent
  //         );
  //       },
  //       onComplete: function () {
  //         this.targets()[0].innerHTML = targetNumber;
  //       },
  //     })
  //     .delay(0.5); // Ajuste le délai avant le démarrage de l'animation
  // });
});
