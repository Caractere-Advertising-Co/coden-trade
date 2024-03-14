// scripts.js (ou tout autre nom que vous avez donné à votre fichier JavaScript)
jQuery(document).ready(function ($) {
  var offset = 9; // Nombre d'articles déjà affichés

  $("#load-more-posts").click(function (e) {
    e.preventDefault();

    $.ajax({
      url: ajax_object.ajax_url, // Utilisation de la variable définie par wp_localize_script()
      type: "POST",
      data: {
        action: "load_more_posts",
        offset: offset,
      },
      success: function (response) {
        $(".grid_articles").append(response);
        offset += 9; // Mettre à jour le décalage pour charger les prochains articles
      },
    });
  });

  $("#load-more-refs").click(function (e) {
    e.preventDefault();

    $.ajax({
      url: ajax_object.ajax_url, // Utilisation de la variable définie par wp_localize_script()
      type: "POST",
      data: {
        action: "load_more_refs",
        offset: offset,
      },
      success: function (response) {
        console.warn(response);
        $(".grid-references").append(response);
        offset += 9; // Mettre à jour le décalage pour charger les prochains articles
      },
    });
  });
});
