<?php

remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );

// Menu 
register_nav_menus( array(
    'megamenu' => 'Mega Menu',
	  'main' => 'Menu Principal',
	  'footer' => 'Bas de page',
    'topheader' => 'Top menu'
) );

add_theme_support( 'post-thumbnails' ); 

//SVG Files
add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {
    global $wp_version;
    if ( $wp_version !== '4.7.1' ) {
       return $data;
    }
  
    $filetype = wp_check_filetype( $filename, $mimes );
  
    return [
        'ext'             => $filetype['ext'],
        'type'            => $filetype['type'],
        'proper_filename' => $data['proper_filename']
    ];
}, 10, 4 );
  
function cc_mime_types( $mimes ){
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
  
function fix_svg() {
    echo '<style type="text/css">
          .attachment-266x266, .thumbnail img {
               width: 100% !important;
               height: auto !important;
          }
          </style>';
}

add_filter( 'upload_mimes', 'cc_mime_types' );
add_action( 'admin_head', 'fix_svg' );


  add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

function enqueue_custom_scripts() {
    // Localisation du script AJAX
    wp_localize_script('custom-scripts', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
}


/*********************************
 Custom Post Type ---- Références
**********************************/

function add_custom_post_references() {

	$labels = array(
		'name'                  => _x( 'Référence.s', 'Post Type General Name', 'custom_post_type' ),
		'singular_name'         => _x( 'Référence', 'Post Type Singular Name', 'custom_post_type' ),
		'menu_name'             => __( 'Références', 'custom_post_type' ),
		'name_admin_bar'        => __( 'Référence', 'custom_post_type' ),
		'archives'              => __( 'Archives', 'custom_post_type' ),
		'attributes'            => __( 'Item Attributes', 'custom_post_type' ),
		'all_items'             => __( 'Toute.s', 'custom_post_type' ),
		'add_new_item'          => __( 'Ajouter une nouvelle référence', 'custom_post_type' ),
		'add_new'               => __( 'Ajouter référence', 'custom_post_type' ),
		'new_item'              => __( 'Nouveau', 'custom_post_type' ),
		'edit_item'             => __( 'Modifier', 'custom_post_type' ),
		'update_item'           => __( 'Mettre à jour', 'custom_post_type' ),
		'view_item'             => __( 'Voir', 'custom_post_type' ),
		'view_items'            => __( 'Voir', 'custom_post_type' ),
		'search_items'          => __( 'Recherche', 'custom_post_type' ),
		'not_found'             => __( 'Non trouvé', 'custom_post_type' ),
		'not_found_in_trash'    => __( 'Non trouvé', 'custom_post_type' ),
		'featured_image'        => __( 'Photo de profil', 'custom_post_type' ),
		'set_featured_image'    => __( 'Définir la photo de profil', 'custom_post_type' ),
		'remove_featured_image' => __( 'Retirer la photo de profil', 'custom_post_type' ),
		'use_featured_image'    => __( 'Utiliser comme photo de profil', 'custom_post_type' ),
		'insert_into_item'      => __( 'Insérer', 'custom_post_type' ),
		'uploaded_to_this_item' => __( 'Uploader', 'custom_post_type' ),
		'items_list'            => __( 'List', 'custom_post_type' ),
		'items_list_navigation' => __( 'Items list navigation', 'custom_post_type' ),
		'filter_items_list'     => __( 'Filtrer', 'custom_post_type' ),
	);
	$args = array(
		'label'                 => __( 'Références', 'custom_post_type' ),
		'description'           => __( 'Références de Coden trade', 'custom_post_type' ),
		'labels'                => $labels,
		'supports'              => array( 'title','thumbnail'),
		'taxonomies'            => array( 'references' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 4,
		'menu_icon'             => 'dashicons-feedback',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'reference', $args );

	// Déclaration de la taxonomie

	$labels = array(
		'name' => 'Type de projet',
		'new_item_name' => 'Nom du type de projet',
		'parent_item' => 'Nom projet parent',
	  );
	
	  $args = array(
		'labels' => $labels,
		'public' => true,
		'show_in_rest' => true,
		'hierarchical' => true,
	  );
	
	  register_taxonomy( 'type-projet', 'reference', $args);

}
add_action( 'init', 'add_custom_post_references', 0 );

/*******************************
Custom Post Type  ---- EMPLOYE
/*******************************/

function add_custom_post_employe() {

	$labels = array(
		'name'                  => _x( 'Employé.e.s', 'Post Type General Name', 'custom_post_type' ),
		'singular_name'         => _x( 'Employé.e', 'Post Type Singular Name', 'custom_post_type' ),
		'menu_name'             => __( 'Employés', 'custom_post_type' ),
		'name_admin_bar'        => __( 'Employés', 'custom_post_type' ),
		'archives'              => __( 'Archives', 'custom_post_type' ),
		'attributes'            => __( 'Item Attributes', 'custom_post_type' ),
		'all_items'             => __( 'Tous', 'custom_post_type' ),
		'add_new_item'          => __( 'Ajouter employé', 'custom_post_type' ),
		'add_new'               => __( 'Créer employé', 'custom_post_type' ),
		'new_item'              => __( 'Nouveau', 'custom_post_type' ),
		'edit_item'             => __( 'Modifier', 'custom_post_type' ),
		'update_item'           => __( 'Mettre à jour', 'custom_post_type' ),
		'view_item'             => __( 'Voir', 'custom_post_type' ),
		'view_items'            => __( 'Voir', 'custom_post_type' ),
		'search_items'          => __( 'Recherche', 'custom_post_type' ),
		'not_found'             => __( 'Non trouvé', 'custom_post_type' ),
		'not_found_in_trash'    => __( 'Non trouvé', 'custom_post_type' ),
		'featured_image'        => __( 'Photo de profil', 'custom_post_type' ),
		'set_featured_image'    => __( 'Définir la photo de profil', 'custom_post_type' ),
		'remove_featured_image' => __( 'Retirer la photo de profil', 'custom_post_type' ),
		'use_featured_image'    => __( 'Utiliser comme photo de profil', 'custom_post_type' ),
		'insert_into_item'      => __( 'Insérer', 'custom_post_type' ),
		'uploaded_to_this_item' => __( 'Uploader', 'custom_post_type' ),
		'items_list'            => __( 'List', 'custom_post_type' ),
		'items_list_navigation' => __( 'Items list navigation', 'custom_post_type' ),
		'filter_items_list'     => __( 'Filtrer', 'custom_post_type' ),
	);
	$args = array(
		'label'                 => __( 'Employés', 'custom_post_type' ),
		'description'           => __( 'Membres de Coden trade', 'custom_post_type' ),
		'labels'                => $labels,
		'supports'              => array( 'title' ),
		'taxonomies'            => array( 'employe' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-groups',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'employe', $args );

}
add_action( 'init', 'add_custom_post_employe', 0 );

add_filter('woocommerce_resize_images', static function() {
    return false;
});

/********************
     WOOCOMMERCE
*********************/

function coden_add_woocommerce_support() {
	add_theme_support( 'woocommerce', array(
		'thumbnail_image_width' => 150,
		'single_image_width'    => 300,

        'product_grid'          => array(
            'default_rows'    => 3,
            'min_rows'        => 2,
            'max_rows'        => 8,
            'default_columns' => 3,
            'min_columns'     => 2,
            'max_columns'     => 5,
        ),
	) );
}
add_action( 'after_setup_theme', 'coden_add_woocommerce_support' );

/**
 * Change number of upsells output
 */
add_filter( 'woocommerce_upsell_display_args', 'wc_change_number_related_products', 20 );

function wc_change_number_related_products( $args ) {
 
 $args['posts_per_page'] = 3;
 $args['columns'] = 3; //change number of upsells here
 return $args;
}

/**
 * @snippet       Plus Minus Quantity Buttons @ WooCommerce Single Product Page
 * @how-to        Get CustomizeWoo.com FREE
 * @author        Rodolfo Melogli
 * @compatible    WooCommerce 8
 * @community     https://businessbloomer.com/club/
 */
 
 add_action( 'woocommerce_before_quantity_input_field', 'bbloomer_display_quantity_minus' );
 
 function bbloomer_display_quantity_minus() {
	if ( ! is_product() ) return;
	echo '<div class="chgQty">
			<button type="button" class="plus" >▲</button>
			<button type="button" class="minus" >▼</button>
		  </div>';
 }
 
 add_action( 'woocommerce_before_single_product', 'bbloomer_add_cart_quantity_plus_minus' );
  
 function bbloomer_add_cart_quantity_plus_minus() {
	wc_enqueue_js( "
	   $('form.cart').on( 'click', 'button.plus, button.minus', function() {
			 var qty = $( this ).closest( 'form.cart' ).find( '.qty' );
			 var val   = parseFloat(qty.val());
			 var max = parseFloat(qty.attr( 'max' ));
			 var min = parseFloat(qty.attr( 'min' ));
			 var step = parseFloat(qty.attr( 'step' ));
			 if ( $( this ).is( '.plus' ) ) {
				if ( max && ( max <= val ) ) {
				   qty.val( max );
				} else {
				   qty.val( val + step );
				}
			 } else {
				if ( min && ( min >= val ) ) {
				   qty.val( min );
				} else if ( val > 1 ) {
				   qty.val( val - step );
				}
			 }
		  });
	" );
 }

/* Load more actualités */

add_action('wp_ajax_load_more_posts', 'load_more_posts');
add_action('wp_ajax_nopriv_load_more_posts', 'load_more_posts');

function load_more_posts() {
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 9,
        'post_status' => 'publish',
        'offset' => $_POST['offset']
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
			$query->the_post();?>
            
			<div class="card_article from-bottom fade-in-bottom">
				<a href="<?php the_permalink();?>" class="red">
					<div class="miniature">
						<img src="<?php if(has_post_thumbnail()) : the_post_thumbnail_url(); endif;?>"/>
					</div>

					<h4><?php the_date();?></h4>
					<h3><?php the_title();?></h3>

					<a href="">Découvrir</a>
				</a>
			</div>
		<?php 
		}
    }

    wp_die();
}

/********************
   *  REFERENCES * 
*********************/ 

/* Load more references */

add_action('wp_ajax_load_more_refs', 'load_more_refs');
add_action('wp_ajax_nopriv_load_more_refs', 'load_more_refs');

function load_more_refs() {
    $args = array(
        'post_type' => 'reference',
        'posts_per_page' => 9,
        'offset' => $_POST['offset']
    );

    $query = new WP_Query($args);

    if ($query->have_posts()):
        while ($query->have_posts()): $query->the_post();
            $intro = get_field('description_projet');
        	$lieu = get_field('lieu_du_projet');
            $galerie = get_field('galerie');
			$thumbnails = null;

            if($galerie):
                $thumbnails = $galerie[0]['url'];
            endif;?>
                        
            <a href="!#" data-index="<?php echo get_the_id();?>" style="background:url('<?php echo $thumbnails;?>');" <?php echo post_class('reference');?>>
                <div class="card-projet">
                    <div class="text">
                        <h3><?php the_title();?></h3>
                        <p><?php if($lieu): echo 'À '.$lieu;endif;?></p>
                    </div>
                    <span class="plus">+</span>
                </div>
            </a>
		<?php 
		endwhile;
    endif;

    wp_die();

	$ajaxposts = new WP_Query([
		'post_type' => 'chantiers',
		'posts_per_page' => 9,
		'orderby' => 'date',
		'paged' => $_POST['paged'],
	  ]);
	
	  $response = '';
	  $max_pages = $ajaxposts->max_num_pages;
	
	  if($ajaxposts->have_posts()) {
		ob_start();
		  while($ajaxposts->have_posts()) : $ajaxposts->the_post();
			$response .= get_template_part('template-parts/card-chantier');
		  endwhile;
	
		  $output = ob_get_contents();
		ob_end_clean();
	  } else {
		$response = '';
	  }
	
	  $result = array(
		'max' => $max_pages,
		'html' => $output,
	  );
	
	  echo json_encode($result);
	  exit;
}

/* Récup infos popup */

function content_popup(){
	$ajaxposts = new WP_Query([
		'post_type' => 'reference',
		'p' => intval($_POST['id']),
	]);
  
	if ($ajaxposts->have_posts()) {
		while ($ajaxposts->have_posts()) : $ajaxposts->the_post();
			$post_data = array(
				'title' => get_the_title(),
				'description' => get_field('description_projet'),
				'type' => get_terms( 'type-projet'),
				'lieu' => get_field('lieu_du_projet'),
				'galerie' => get_field('galerie'),
			);

			foreach($post_data['type'] as $type):
				$t = $type->name;
			endforeach;
  
			ob_start();
			?>
			
			<div class="popup-content">
			  <div class="col_details">
				<p class="meta">Type : <?php echo $t;?></p>
				<p class="meta">Lieu : <?php echo $post_data['lieu']; ?></p>
				<?php echo $post_data['description']; ?>
			  </div>
			  
			  <div class="col-slider">
			  	<div class="close">X</div>
  
				<?php if($post_data['galerie']) : ?>
				  <div class="swiper swiper-reference">
					<div class="swiper-wrapper">
					  <?php foreach($post_data['galerie'] as $img) :?>
						<div class="swiper-slide" style="background:url('<?php echo $img['url'];?>');">
						</div>
					  <?php endforeach;?>
					</div>
  
					<div class="swiper-button-next"></div>
					<div class="swiper-button-prev"></div>  
				  </div>
					
				<?php else :?>
				  <div class="full-size" style="background:url('<?php echo $post_data['thumbnails'];?>');">
				  </div>
				<?php endif;?>
			  </div>
			</div>
  
			<?php
			$response['template_content'] = ob_get_clean(); // Récupère le contenu du template après l'inclusion
		endwhile;
	} else {
		$response['template_content'] = ''; // Aucun post trouvé, réponse vide
	}
  
	wp_reset_postdata(); // Réinitialise les données du post
  
	echo json_encode($response);
	exit;
}
  
  
add_action('wp_ajax_content_popup', 'content_popup');
add_action('wp_ajax_nopriv_content_popup', 'content_popup');