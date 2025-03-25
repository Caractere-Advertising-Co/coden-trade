$(document).ready(function () {
  // Utilisation de l'événement délégué pour les éléments ".type-reference"
  $(document).on("click", ".type-reference", show_ref_popup);

  function show_ref_popup(e) {
    e.preventDefault();
    var ref = $(this).data("index");

    console.log(ref);

    $("#popup_reference").css("display", "flex");

    $.ajax({
      type: "POST",
      url: "/wp-admin/admin-ajax.php",
      dataType: "json",
      data: {
        action: "content_popup",
        id: ref,
      },
      success: function (res) {
        if (res.template_content && res.template_content.trim() !== "") {
          $(".container_popup").empty().append(res.template_content);

          const swiper_thumbs = new Swiper(".swiper-thumbs", {
            spaceBetween: 10,
            slidesPerView: 4,
            freeMode: true,
            watchSlidesProgress: true,
          });

          // Initialisation du Swiper une fois que le contenu est ajouté
          const swiper_ref = new Swiper(".swiper-reference", {
            cssMode: true,
            autoplay: true,
            loop: true,
            navigation: {
              nextEl: ".swiper-button-next",
              prevEl: ".swiper-button-prev",
            },
          });
        } else {
          console.log("La réponse est vide ou nulle.");
        }
      },
    });
  }

  $(document).on("click", function (event) {
    if (
      !$(event.target).closest(
        ".container_popup, .type-reference, .see-details-fp"
      ).length ||
      $(event.target).hasClass("close")
    ) {
      closePopup();
    }
  });

  function closePopup() {
    $(".container_popup").empty();
    $("#popup_reference").hide();
  }

  
  var modal = document.getElementById('#modal_popup_front');

  // Fermeture de la popup lors du clic sur le bouton de fermeture

  $('#close_popup').on('click',function(event){
    $('#modal_popup_front').css("display","none");
  });

  // Fermeture de la popup lors du clic en dehors du contenu
  $(window).on('click', function(event) {
    if (event.target == modal) {
      modal.css("display","none");
    }
  });
});