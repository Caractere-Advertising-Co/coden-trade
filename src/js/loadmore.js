// scripts.js (ou tout autre nom que vous avez donné à votre fichier JavaScript)
jQuery(document).ready(function ($) {
  let offset = 9; // Initial offset value

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
        
        // Vérifier s'il n'y a plus d'articles à charger
        if (response.trim() === '' || offset >= total_posts) {
          $("#load-more-posts").hide();
      }
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
